<?php
namespace Calliope\Core\Connection\Paging\Page;

use Calliope\Core\Connection\Paging\ConnectionFetchPagerInterface;
use Clio\Component\Container\Collection\LazyLoadCollection;
use Clio\Component\Container\Collection;
use Clio\Component\Container\Storage\ArrayStorage;
use Clio\Bridge\DoctrineCollection\Container\Storage\DoctrineCollectionStorage;
use Clio\Component\Normalizer\Normalizable;

use Calliope\Core\Exception\UnsupportedException;


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
class ConnectionPage extends LazyLoadCollection implements ConnectionPageInterface, Normalizable 
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
		parent::__construct(array($this, '_load'));

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
	public function _load()
	{
		$collection = $this->getConnection()->findBy(
			$this->getCriteria(),
			$this->getOrderBy(),
			$this->getRequestSize(),
			$this->getOffset()
		);

		if($collection instanceof Collection) {
			$storage = new ArrayStorage($collection->toArray());
		} else if(is_array($collection)) {
			$storage = new ArrayStorage($collection);
		} else {
			throw new \RuntimeException('Failed to load');
		}

		return $storage;
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
        return $this->getStorage()->count();
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
			try {
				$this->total = $this->getPager()->getTotal();
			} catch(UnsupportedException $ex) {
				return null;
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

	public function normalize()
	{
		return array(
			'total' => $this->getTotal(),
			'size'  => $this->getSize(),
			'offset' => $this->getOffset(),
			'request_size'  => $this->getRequestSize(),
			'data'  => $this->toArray(),
		);
	}

	public function denormalize(array $normalized)
	{
		$this->total = $normalized['total'];
		$this->size  = $normalized['size'];
		$this->requestSize = $normalized['request_size'];
		$data = $normalized['data'];
	}
}

