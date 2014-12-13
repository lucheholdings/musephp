<?php
namespace Clio\Adapter\DoctrineExtensions\Query\Condition;

use Clio\Component\Util\Query\Condition\FieldCondition,
	Clio\Component\Util\Query\Condition\FieldValueCondition,
	Clio\Component\Util\Query\Condition\ComparisonalCondition,
	Clio\Component\Util\Query\Condition\CollectionalCondition
;
use Doctrine\ORM\QueryBuilder;


/**
 * DoctrineFieldCondition
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DoctrineFieldCondition extends DoctrineCondition
{
	private $condition;

	public function __construct(FieldValueCondition $cond, $field, $parentAlias = null)
	{
		$this->condition = $cond;

		parent::__construct($field, $parentAlias);
	}

	/**
	 * applyToQueryBuilder 
	 * 
	 * @param QueryBuilder $qb 
	 * @access public
	 * @return void
	 */
	public function applyToQueryBuilder(QueryBuilder $qb)
	{
		if($this->condition) {
			$parentAlias = $this->getParentAlias();
			if(!$parentAlias) {
				$parentAlias = $qb->getRootAlias();
			}
			// 
			$params = new DoctrineQueryParamBag();
			$cond = $this->doApplyCondition($qb, $this->condition, $parentAlias. '.' . $this->getField(), $params);

			// Set parameters
			foreach($params as $key => $value) {
				$qb->setParameter($key, $value);
			}
			$qb->andWhere($cond);
		}
	}

    
    /**
     * Get condition.
     *
     * @access public
     * @return condition
     */
    public function getCondition()
    {
        return $this->condition;
    }
    
    /**
     * Set condition.
     *
     * @access public
     * @param condition the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setCondition($condition)
    {
        $this->condition = $condition;
        return $this;
    }
}

