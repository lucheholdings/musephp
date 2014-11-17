<?php
namespace Erato\Adapter\DoctrineORM\Core\Entity;

use Doctrine\ORM\Query;
use Doctrine\ORM\Query\ResultSetMapping;

use Erato\Adapter\DoctrineORM\Core\Criteria\CriteriaBuilder,
	Erato\Adapter\DoctrineORM\Core\Criteria\DefaultCriteriaBuilder
;

/**
 * CriteriaSchemaRepository 
 * 
 * @uses EntityRepository
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class CriteriaSchemaRepository extends AbstractSchemaRepository implements SchemaRepository
{
	/**
	 * criteriaBuilderFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $criteriaBuilderFactory;

	/**
	 * createQueryBy
	 * 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @param mixed $limit 
	 * @param mixed $offset 
	 * @param QueryBuilder $qb 
	 * @access public
	 * @return void
	 */
	public function createQueryBy(array $criteria = array(), array $orderBy = array(), $limit = null, $offset = null, QueryBuilder $qb = null)
	{
		$cb = $this->createCriteriaBuilder();
		$c = $cb
			->setConditions($criteria)
			->setOrders($orderBy)
			->setLimit($limit)
			->setOffset($offset)
			->build()
		;

		if(!$qb) {
			$qb = $this->createQueryBuilder('q');
		}
		$query = $qb->addCriteria($c)->getQuery();
		
		return $query;
	}
    
    /**
     * Get criteriaBuilderFactory.
     *
     * @access public
     * @return criteriaBuilderFactory
     */
    public function getCriteriaBuilderFactory()
    {
        return $this->criteriaBuilderFactory;
    }
    
    /**
     * Set criteriaBuilderFactory.
     *
     * @access public
     * @param criteriaBuilderFactory the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setCriteriaBuilderFactory($criteriaBuilderFactory)
    {
        $this->criteriaBuilderFactory = $criteriaBuilderFactory;
        return $this;
    }

	/**
	 * createCriteriaBuilder 
	 * 
	 * @access public
	 * @return void
	 */
	public function createCriteriaBuilder()
	{
		$factory = $this->getCriteriaBuilderFactory();
		if($factory) {
			return $this->getCriteriaBuilderFactory()->create();
		} 

		return new DefaultCriteriaBuilder();
	}
}

