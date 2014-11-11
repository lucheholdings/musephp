<?php
namespace Calliope\Framework\Core\Connection\Paging\Page;

use Calliope\Framework\Core\Connection\Paging\ConnectionFetchPagerInterface;
use Clio\Component\Util\Container\Collection\LazyLoadCollection;
use Clio\Component\Util\Container\Collection\Collection;

/**
 * ConnectionPage 
 * 
 * @uses LazyLoadCollection
 * @uses PageInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ConnectionPage extends LazyLoadCollection implements ConnectionPageInterface 
{
	/**
	 * pager 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $pager;

	/**
	 * size 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $size;

	/**
	 * total 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $total;

	/**
	 * requestSize 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $requestSize;

	/**
	 * offset 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $offset;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(ConnectionFetchPagerInterface $pager, $size, $offset)
	{
		parent::__construct();

		$this->pager = $pager;
		$this->requestSize = $size;
		$this->offset = $offset;
	}

	/**
	 * _load 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function _load()
	{
		$collection = $this->getConnection()->findBy(
			$this->getCriteria(),
			$this->getOrderBy(),
			$this->getRequestSize(),
			$this->getOffset()
		);

		if(is_array($collection)) {
			$collection = new Collection($collection);
		} 

		$this->setCollection($collection);
		$this->setSize(count($collection));

		return $this->getCollection();
	}

    
    /**
     * Get connection.
     *
     * @access public
     * @return connection
     */
    public function getConnection()
    {
        return $this->getPager()->getConnection();
    }
    
    /**
     * Get criteria.
     *
     * @access public
     * @return criteria
     */
    public function getCriteria()
    {
        return $this->getPager()->getCriteria();
    }
    
    /**
     * Get orderBy.
     *
     * @access public
     * @return orderBy
     */
    public function getOrderBy()
    {
        return $this->getPager()->getOrderBy();
    }
    
    /**
     * Get size.
     *
     * @access public
     * @return size
     */
    public function getSize()
    {
        return $this->size;
    }
    
    /**
     * Set size.
     *
     * @access public
     * @param size the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setSize($size)
    {
        $this->size = $size;
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
    
    /**
     * Get pager.
     *
     * @access public
     * @return pager
     */
    public function getPager()
    {
        return $this->pager;
    }
    
    /**
     * Set pager.
     *
     * @access public
     * @param pager the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setPager($pager)
    {
        $this->pager = $pager;
        return $this;
    }

	/**
	 * getTotal 
	 * 
	 * @access public
	 * @return void
	 */
	public function getTotal()
	{
		if(!$this->total) {
			if($this->isLoaded() && ($this->getCollection() instanceof ConnectionPage)) {
				$this->total = $this->getCollection()->getTotal();
			} else {
				$this->total = $this->getPager()->getTotal();
			}
		}
		return $this->total;
	}
    
    /**
     * Get requestSize.
     *
     * @access public
     * @return requestSize
     */
    public function getRequestSize()
    {
        return $this->requestSize;
    }
    
    /**
     * Set requestSize.
     *
     * @access public
     * @param requestSize the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setRequestSize($requestSize)
    {
        $this->requestSize = $requestSize;
        return $this;
    }
}

