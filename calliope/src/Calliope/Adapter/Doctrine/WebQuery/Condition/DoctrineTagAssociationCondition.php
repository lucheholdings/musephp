<?php
namespace Calliope\Adapter\Doctrine\WebQuery\Condition;

use Calliope\Framework\WebQuery\Condition\FieldCondition,
	Calliope\Framework\WebQuery\Condition\FieldValueCondition,
	Calliope\Framework\WebQuery\Condition\ComparisonalCondition,
	Calliope\Framework\WebQuery\Condition\CollectionalCondition
;
use Doctrine\ORM\QueryBuilder;
use Clio\Component\Util\Grammer\Grammer;
/**
 * DoctrineTagAssociationCondition 
 * 
 * @uses DoctrineAssociationCondition
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DoctrineTagAssociationCondition extends DoctrineAssociationCondition 
{
	public function applyToQueryBuilder(QueryBuilder $qb)
	{
		$parentAlias = $this->getParentAlias() ?: $qb->getRootAlias();
		$params = new DoctrineQueryParamBag();
		// 1. get unique tag name list
		$names = $this->getUniqueTagNames($this->joinConditions);
		// 1. join all tags.
		$this->joinTags($qb, $names, $params, $parentAlias);
		// 2. convert the condition to isValueAny 
		$cond = $this->doApplyCondition($qb, $this->joinConditions, null, $params);
		$qb->andWhere($cond);

		// Set parameters
		foreach($params as $key => $value) {
			$qb->setParameter($key, $value);
		}
	}

	public function getUniqueTagNames($cond)
	{
		$names = array();

		if($cond instanceof CollectionalCondition) {
			foreach($cond->getConditions() as $innerCond) {
				$names = array_merge($names, $this->getUniqueTagNames($innerCond));
			}
		} else if($cond instanceof ComparisonalCondition) {
			$names = $cond->getValue();
			if(!is_array($names)) {
				$names = array($names);
			}
		}

		return array_unique($names);
	}

	protected function joinTags($qb, $names, $params, $parentAlias)
	{
		$field = $this->getField();
		foreach($names as $name) {
			$joinedTable = $this->getTableNameFor($name);
			$qb->leftJoin($parentAlias . '.' . $field, $joinedTable, 'WITH', $qb->expr()->eq($joinedTable . '.name', ':' . $params->add($name)));
		}
	}

	protected function getTableNameFor($name)
	{
		return 'tag_' . Grammer::snakize($name);
	}

	protected function doApplyCondition($qb, FieldValueCondition $condition, $fieldName, $params)
	{
		$cond = null;
		if($condition instanceof CollectionalCondition) {
			//
			switch($condition->getOperator()) {
			case CollectionalCondition::OPERATOR_OR:
				$cond = $qb->expr()->orX();
				break;
			case CollectionalCondition::OPERATOR_AND:
				$cond = $qb->expr()->andX();
				break;
			default:
				break;
			}

			foreach($condition->getConditions() as $innerCond) {
				$cond->add($this->doApplyCondition($qb, $innerCond, $fieldName, $params));
			}
		} else {
			// Comparison
			switch($condition->getOperator()) {
			case ComparisonalCondition::OPERATOR_EQ:
				$table = $this->getTableNameFor($condition->getValue());
				$cond = $qb->expr()->isNotNull($table . '.name');
				break;
			case ComparisonalCondition::OPERATOR_NE:
				$table = $this->getTableNameFor($condition->getValue());
				$cond = $qb->expr()->isNull($table . '.name');
				break;
			case ComparisonalCondition::OPERATOR_IN:
				// this is same as OR
				$cond = $qb->expr()->orX();
				foreach($condition->getValue() as $value) {
					$cond->add($this->doApplyCondition($qb, new ComparisonalCondition($value), $fieldName, $params));
				}
				break;
			case ComparisonalCondition::OPERATOR_GT:
			case ComparisonalCondition::OPERATOR_GE:
			case ComparisonalCondition::OPERATOR_LT:
			case ComparisonalCondition::OPERATOR_LE:
			case ComparisonalCondition::OPERATOR_MATCH:
			default:
				throw new \Exception('Tag only support =:name or !=:name');
				break;
			}
		}

		return $cond;
	}
}


