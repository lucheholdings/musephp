<?php
namespace Calliope\Core\Filter\Condition;

use Calliope\Core\Connection;
/**
 * FetchCondition 
 * 
 * @uses Condition
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FetchCondition extends Condition 
{
	private $criteria;

	private $orderBy;

	private $limit;

	private $offset;

	/**
	 * __construct 
	 * 
	 * @param Connection $connection 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @param mixed $limit 
	 * @param mixed $offset 
	 * @access public
	 * @return void
	 */
	public function __construct(Connection $connection, array $criteria, array $orderBy = array(), $limit = null, $offset = null)
	{
		parent::__construct($connection);

		$this->criteria = $criteria;
		$this->orderBy = $orderBy;
		$this->limit = $limit;
		$this->offset = $offset;
	}
    
    /**
     * Get criteria.
     *
     * @access public
     * @return criteria
     */
    public function getCriteria()
    {
        return $this->criteria;
    }
    
    /**
     * Set criteria.
     *
     * @access public
     * @param criteria the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setCriteria($criteria)
    {
        $this->criteria = $criteria;
        return $this;
    }
    
    /**
     * Get orderBy.
     *
     * @access public
     * @return orderBy
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }
    
    /**
     * Set orderBy.
     *
     * @access public
     * @param orderBy the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;
        return $this;
    }
    
    /**
     * Get limit.
     *
     * @access public
     * @return limit
     */
    public function getLimit()
    {
        return $this->limit;
    }
    
    /**
     * Set limit.
     *
     * @access public
     * @param limit the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }
    
    /**
     * Get offset.
     *
     * @access public
     * @return offset
     */
    public function getOffset()
    {
        return $this->offset;
    }
    
    /**
     * Set offset.
     *
     * @access public
     * @param offset the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
        return $this;
    }
}

