<?php
namespace Calliope\Core\Connection\Paging;

use Calliope\Core\Connection;

/**
 * ConnectionPager 
 * 
 * @uses PagerInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ConnectionFetchPager implements ConnectionFetchPagerInterface 
{
	/**
	 * connection 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $connection;

	/**
	 * criteria 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $criteria;

	/**
	 * orderBy 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $orderBy;

	/**
	 * pageSize 
	 * 
	 * @var mixed
	 * @access protected
	 */
	private $pageSize;

	/**
	 * total 
	 * 
	 * @var mixed
	 * @access protected
	 */
	private $_total;

	private $postLoadCallback;

	/**
	 * __construct 
	 * 
	 * @param Connection $connection 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @param mixed $pageSize 
	 * @access public
	 * @return void
	 */
	public function __construct(Connection $connection, array $criteria, array $orderBy = array(), $pageSize)
	{
		$this->connection = $connection;
		$this->criteria = $criteria;
		$this->orderBy = $orderBy;
		$this->pageSize = $pageSize;
	}

	/**
	 * createPageAt 
	 * 
	 * @param mixed $offset 
	 * @access protected
	 * @return void
	 */
	public function createPageAt($offset)
	{
		$size = $this->getPageSize();

		if($offset < 0) {
			$size -= $offset;
			$offset = 0;
		}

		$page = new Page\ConnectionPage(
			$this,
			$size,
			$offset
		);

		if($this->postLoadCallback) {
			$page->addPostLoadCallback($this->postLoadCallback);
		}
		return $page;
	}

	/**
	 * getPage 
	 * 
	 * @param int $page 
	 * @access public
	 * @return void
	 */
	public function getPage($page)
	{
		if($page <= 0) {
			throw new \RuntimeException('Page number has to be a positive int.');
		}
		$page = $this->createPageAt(($page - 1) * $this->getPageSize());

		if($this->postLoadCallback) {
			$page->addPostLoadCallback($this->postLoadCallback);
		}
		return $page;
	}

	/**
	 * getPages 
	 * 
	 * @access public
	 * @return void
	 */
	public function getPages()
	{
		$pages = array();
		$maxPage = $this->getMaxPage();

		for($i = 1; $i <= $maxPage; $i++) {
			$pages[] = $this->getPage($i);
		}

		return $pages;
	}
    
    /**
     * Get connection.
     *
     * @access public
     * @return connection
     */
    public function getConnection()
    {
        return $this->connection;
    }
    
    /**
     * Set connection.
     *
     * @access public
     * @param connection the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;
        return $this;
    }

    /**
     * Get _total.
     *
     * @access public
     * @return _total
     */
    public function getTotal()
    {
		if(!$this->_total) {
			$this->_total = $this->getConnection()->countBy($this->getCriteria());
		}
        return $this->_total;
    }
    
    /**
     * Set _total.
     *
     * @access public
     * @param _total the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setTotal($total)
    {
        $this->_total = $total;
        return $this;
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
     * Get pageSize.
     *
     * @access public
     * @return pageSize
     */
    public function getPageSize()
    {
        return $this->pageSize;
    }
    
    /**
     * Set pageSize.
     *
     * @access public
     * @param pageSize the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;
        return $this;
    }

	/**
	 * getMaxPage 
	 * 
	 * @access public
	 * @return void
	 */
	public function getMaxPage()
	{
		return ceil($this->getTotal()/$this->getPageSize());
	}
    
    /**
     * Get postLoadCallback.
     *
     * @access public
     * @return postLoadCallback
     */
    public function getPostLoadCallback()
    {
        return $this->postLoadCallback;
    }
    
    /**
     * Set postLoadCallback.
     *
     * @access public
     * @param postLoadCallback the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setPostLoadCallback(\Closure $postLoadCallback)
    {
        $this->postLoadCallback = $postLoadCallback;
        return $this;
    }
}

