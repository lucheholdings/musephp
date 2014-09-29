<?php
namespace Calliope\Adapter\Doctrine\WebQuery\Condition;

use Calliope\Framework\WebQuery\Condition\FieldCondition,
	Calliope\Framework\WebQuery\Condition\FieldValueCondition,
	Calliope\Framework\WebQuery\Condition\ComparisonalCondition,
	Calliope\Framework\WebQuery\Condition\CollectionalCondition
;
use Doctrine\ORM\QueryBuilder;
use Clio\Component\Util\Hash\HashUtil;
/**
 * DoctrineAssociationQueryCondition 
 * 
 * @uses DoctrineQueryCondition
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DoctrineAssociationCondition extends DoctrineCondition
{
	private $tableAlias;

	private $joinType;

	protected $joinConditions;

	private $fieldConditions = array();

	public function __construct($field, $parentAlias = null, $joinConds = array(), $joinType = 'left')
	{
		parent::__construct($field, $parentAlias);

		$this->joinType = $joinType;
		$this->joinConditions = $joinConds;

		$this->tableAlias = 'join_' . HashUtil::generateHash(8);
	}

	public function applyToQueryBuilder(QueryBuilder $qb)
	{
		$parentAlias = $this->getParentAlias() ?: $qb->getRootAlias();
		$params = new DoctrineQueryParamBag();

		$joinMethod = $this->getJoinMethodFor($this->joinType);

		//if($this->joinConditions && !is_array($this->joinConditions)) {
		//	$this->joinConditions = array($this->joinConditions);	
		//}

		$joinedTable = $this->getTableAlias();

		if(!empty($this->joinConditions)) {
			$cond = $qb->expr()->orx();
			
			// 
			$cond->add($this->doApplyCondition($qb, $this->joinConditions->getValueCondition(), $joinedTable . '.' . $this->joinConditions->getField(), $params));

			$qb->$joinMethod($parentAlias . '.' . $this->getField(), $joinedTable, 'WITH', $cond);
		} else {
			$qb->$joinMethod($parentAlias . '.' . $this->getField(), $joinedTable);
		}
		
		foreach($this->fieldConditions as $cond) {
			$cond->setParentAlias($joinedTable);
			$cond->applyToQueryBuilder($qb);
		}

		// Set parameters
		foreach($params as $key => $value) {
			$qb->setParameter($key, $value);
		}
	}

	protected function getJoinMethodFor($type)
	{
		switch($type) {
		case 'left':
			return 'leftJoin';
			break;
		case 'right':
			return 'rightJoin';
			break;
		case 'inner':
			return 'innerJoin';
			break;
		default:
			throw new \RuntimeException(sprintf('Unsupported join type "%s"', $type));
		}
	}
	
	public function addFieldCondition(DoctrineFieldCondition $cond)
	{
		$this->fieldConditions[] = $cond;
	}

    
    /**
     * Get tableAlias.
     *
     * @access public
     * @return tableAlias
     */
    public function getTableAlias()
    {
        return $this->tableAlias;
    }
}

