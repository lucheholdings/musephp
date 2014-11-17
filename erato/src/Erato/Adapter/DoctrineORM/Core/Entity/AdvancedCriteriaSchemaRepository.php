<?php
namespace Erato\Adapter\DoctrineORM\Core\Entity;

use Doctrine\ORM\QueryBuilder;

use Erato\Adapter\DoctrineORM\WebQuery\Condition\Resolver\DoctrineConditionResolver;
use Erato\Core\CodingStandard;

/**
 * AdvancedCriteriaSchemaRepository 
 * 
 * @uses AbstractSchemaRepository
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AdvancedCriteriaSchemaRepository extends AbstractSchemaRepository 
{
	/**
	 * conditionResolver
	 * 
	 * @var mixed
	 * @access private
	 */
	private $conditionResolver;

	/**
	 * defaultOrderBy 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $defaultOrderBy;

	/**
	 * createQueryBy 
	 * 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @param mixed $limit 
	 * @param mixed $offset 
	 * @access public
	 * @return void
	 */
	public function createQueryBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null)
	{
		$qb = $this->createQueryBuilderBy($criteria, $orderBy);

		$query = $qb->getQuery();

		if($limit) {
			$query->setMaxResults($limit);
		}

		if($offset) {
			$query->setFirstResult($offset);
		}

		return $query;
	}

	public function createQueryBuilderBy(array $criteria, array $orderBy = array()) 
	{
		$qb = $this->createQueryBuilder('q');
		$qb->select('q');

		// Append Query Conditioin -updating where clouds- on QueryBuilder
		foreach($criteria as $key => $value) {
			// Join Or Where for specified field key
			$cond = $this->createFieldCondition($key, $value);

			if($cond) {
				$cond->applyToQueryBuilder($qb);
			}
		}

		// Update OrderBy Parts
		if(!$orderBy) {
			$orderBy = $this->getDefaultOrderBy();
		}

		// 
		if($orderBy && is_array($orderBy) && !empty($orderBy)) {
			foreach($orderBy as $sortedBy => $order) {
				// if the index is numeric, use ASC as default. 
				if(is_numeric($sortedBy)) {
					$sortedBy = $order;
					$order = 'ASC';
				}

				$this->applyFieldSort($qb, $sortedBy, $order);
			}
		}
		
		return $qb;
	}
    
    /**
     * Get defaultOrderBy.
     *
     * @access public
     * @return defaultOrderBy
     */
    public function getDefaultOrderBy()
    {
        return $this->defaultOrderBy;
    }
    
    /**
     * Set defaultOrderBy.
     *
     * @access public
     * @param defaultOrderBy the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setDefaultOrderBy($defaultOrderBy)
    {
        $this->defaultOrderBy = $defaultOrderBy;
        return $this;
    }

	/**
	 * createFieldCondition 
	 * 
	 * @param QueryBuilder $qb 
	 * @param mixed $field 
	 * @param mixed $value 
	 * @access protected
	 * @return void
	 */
	protected function createFieldCondition($field, $value, $parentAlias = null)
	{
		// First check where override method exists or no
		$method = $this->getCoding()->formatMethodName('createFieldCondition', $field);
		if(method_exists($this, $method)) {
			// now we delegate to this override method.
			$cond = $this->$method($field, $value, $parentAlias);
		} else {
			// Create DoctrineCondition
			$cond = $this->getConditionResolver()->resolveCondition($field, $value, $parentAlias);
		}

		return $cond;
	}

	/**
	 * applyFieldSort 
	 * 
	 * @param QueryBuilder $qb 
	 * @param mixed $field 
	 * @param mixed $sort 
	 * @access protected
	 * @return void
	 */
	protected function applyFieldSort(QueryBuilder $qb, $field, $order)
	{
		$alias = $qb->getRootAlias();
		// First check where override method exists or no
		$method = $this->getCoding()->formatMethodName('applyFieldSort', $field);
		if(method_exists($this, $method)) {
			// now we delegate to this override method.
			$this->$method($qb, $field, $order);
		} else {
			$doctrineMetadata = $this->getClassMetadata();
			$camField = $this->getCoding()->formatPropertyName($field);
			// Otherwise use default.
			if($doctrineMetadata->hasField($camField)) {
				// Field exists, so try Simple Sort Field
				$qb->addOrderBy($alias . '.' . $camField, $order);
			} else {
				//
				throw new \InvalidArgumentException(sprintf('Unknown field "%s" is given on orderBy for Table "%s".', $field, $this->getClassMetadata()->getName()));
			}
		}
	}
    
    /**
     * Get conditionResolver.
     *
     * @access public
     * @return conditionResolver
     */
    public function getConditionResolver()
    {
		if(!$this->conditionResolver) {
			$this->conditionResolver = new DoctrineConditionResolver($this->getClassMetadata());
		}
        return $this->conditionResolver;
    }
    
    /**
     * Set conditionResolver.
     *
     * @access public
     * @param conditionResolver the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setConditionResolver($conditionResolver)
    {
        $this->conditionResolver = $conditionResolver;
        return $this;
    }

	public function getCoding()
	{
		if(!$this->coding) {
			$this->coding = new CondingStandard();
		}

		return $this->coding;
	}

	public function setCoding(CodingStandard $coding)
	{
		$this->coding = $coding;
	}
}

