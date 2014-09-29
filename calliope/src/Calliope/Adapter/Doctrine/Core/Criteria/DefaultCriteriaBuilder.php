<?php
namespace Calliope\Adapter\Doctrine\Core\Criteria;

use Doctrine\Common\Collections\Criteria; 

/**
 * DefaultCriteriaBuilder 
 * 
 * @uses CriteriaBuilder
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DefaultCriteriaBuilder implements CriteriaBuilder
{
	/**
	 * conditions 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $conditions;
	
	/**
	 * orders 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $orders;

	/**
	 * limit 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $limit;

	/**
	 * offset 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $offset;

	/**
	 * __construct 
	 * 
	 * @param array $conditions 
	 * @param array $orders 
	 * @param mixed $limit 
	 * @param mixed $offset 
	 * @access public
	 * @return void
	 */
	public function __construct(array $conditions = array(), array $orders = array(), $limit = null, $offset = null)
	{
		$this->conditions = $conditions;
		$this->orders = $orders;
		$this->limit = $limit;
		$this->offset = $offset;
	}

	/**
	 * build 
	 * 
	 * @access public
	 * @return void
	 */
	public function build()
	{
		$c = new Criteria();

		return $this->doBuild($c);
	}

	/**
	 * doBuild 
	 * 
	 * @param Criteria $c 
	 * @access protected
	 * @return void
	 */
	protected function doBuild(Criteria $c)
	{
		foreach($this->getConditions() as $field => $value) {
			if(is_array($value)) {
				$c->andWhere($c->expr()->in($field, $value));
			} else if(is_scalar($value)) {
				$c->andWhere($c->expr()->eq($field, $value));
			}
		}

		foreach($this->getOrders() as $field => $order) {
			if(is_numeric($field)) {
				$c->addOrderBy($order, Criteria::ASC);
			} else {
				switch(strtolower($order)) {
				case 'd':
				case 'desc':
					$c->addOrderBy($field, Criteria::DESC);
					break;
				case 'a':
				case 'asc':
				default:
					$c->addOrderBy($field, Criteria::ASC);
					break;
				}
			}
		}

		if($this->getLimit()) {
			$c->setMaxResults($this->getLimit());
		}
		if($this->getOffset()) {
			$c->setFirstResult($this->getOffset());
		}

		return $c;
	}
    
    /**
     * Get conditions.
     *
     * @access public
     * @return conditions
     */
    public function getConditions()
    {
        return $this->conditions;
    }
    
    /**
     * Set conditions.
     *
     * @access public
     * @param conditions the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setConditions(array $conditions)
    {
        $this->conditions = $conditions;
        return $this;
    }
    
    /**
     * Get orders.
     *
     * @access public
     * @return orders
     */
    public function getOrders()
    {
        return $this->orders;
    }
    
    /**
     * Set orders.
     *
     * @access public
     * @param orders the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setOrders(array $orders)
    {
        $this->orders = $orders;
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

