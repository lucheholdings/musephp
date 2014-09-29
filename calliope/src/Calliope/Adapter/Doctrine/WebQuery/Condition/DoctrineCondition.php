<?php
namespace Calliope\Adapter\Doctrine\WebQuery\Condition;

use Calliope\Framework\WebQuery\Condition\FieldCondition,
	Calliope\Framework\WebQuery\Condition\FieldValueCondition,
	Calliope\Framework\WebQuery\Condition\ComparisonalCondition,
	Calliope\Framework\WebQuery\Condition\CollectionalCondition
;
use Doctrine\ORM\QueryBuilder;


/**
 * DoctrineCondition 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class DoctrineCondition
{
	private $field;

	private $parentAlias;

	public function __construct($field, $parentAlias = null)
	{
		$this->field = $field;
		$this->parentAlias = $parentAlias;
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
			$paramValue = $this->applyParamValue($condition, $params);
			// Comparison
			switch($condition->getOperator()) {
			case ComparisonalCondition::OPERATOR_EQ:
				if($condition->isValueAny()) {
					$cond = $qb->expr()->isNotNull($fieldName);
				} else if($condition->isValueNull()) {
					$cond = $qb->expr()->isNull($fieldName);
				} else {
					$cond = $qb->expr()->eq($fieldName, $paramValue);
				}
				break;
			case ComparisonalCondition::OPERATOR_NE:
				$cond = $qb->expr()->neq($fieldName, $paramValue);
				break;
			case ComparisonalCondition::OPERATOR_GT:
				$cond = $qb->expr()->gt($fieldName, $paramValue);
				break;
			case ComparisonalCondition::OPERATOR_GE:
				$cond = $qb->expr()->gte($fieldName, $paramValue);
				break;
			case ComparisonalCondition::OPERATOR_LT:
				$cond = $qb->expr()->lt($fieldName, $paramValue);
				break;
			case ComparisonalCondition::OPERATOR_LE:
				$cond = $qb->expr()->lte($fieldName, $paramValue);
				break;
			case ComparisonalCondition::OPERATOR_IN:
				$cond = $qb->expr()->in($fieldName, $paramValue);
				break;
			case ComparisonalCondition::OPERATOR_MATCH:
				$cond = $qb->expr()->like($fieldName, $qb->expr()->literal($paramValue));
				break;
			default:
				throw new \Exception('Invalid');
				break;
			}
		}

		return $cond;
	}

	protected function applyParamValue($condition, DoctrineQueryParamBag $params)
	{
		$paramValue = $condition->getValue();

		switch($condition->getOperator()) {
		case ComparisonalCondition::OPERATOR_EQ:
		case ComparisonalCondition::OPERATOR_NE:
		case ComparisonalCondition::OPERATOR_GT:
		case ComparisonalCondition::OPERATOR_GE:
		case ComparisonalCondition::OPERATOR_LT:
		case ComparisonalCondition::OPERATOR_LE:
			if($condition->isValueRaw() && is_string($paramValue)) {
				// set Unique ParamKey
				$paramValue = ':'.$params->add($paramValue);
			}
			break;
		default:
			break;
		}
		return $paramValue;
	}
    
    /**
     * Get field.
     *
     * @access public
     * @return field
     */
    public function getField()
    {
        return $this->field;
    }
    
    /**
     * Set field.
     *
     * @access public
     * @param field the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setField($field)
    {
        $this->field = $field;
        return $this;
    }
    
    /**
     * Get parentAlias.
     *
     * @access public
     * @return parentAlias
     */
    public function getParentAlias()
    {
        return $this->parentAlias;
    }
    
    /**
     * Set parentAlias.
     *
     * @access public
     * @param parentAlias the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setParentAlias($parentAlias)
    {
        $this->parentAlias = $parentAlias;
        return $this;
    }
}

