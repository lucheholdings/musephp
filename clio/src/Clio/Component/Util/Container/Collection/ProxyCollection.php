<?php
namespace Clio\Component\Util\Container\Collection;

use Clio\Component\Util\Container\Collection as CollectionInterface; 
/**
 * ProxyCollection 
 * 
 * @uses Collection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ProxyCollection extends AbstractCollection implements CollectionInterface
{
	/**
	 * collection 
	 * 
	 * @var mixed
	 * @access protected
	 */
	private $collection;

	/**
	 * __construct 
	 * 
	 * @param CollectionInterface $collection 
	 * @access public
	 * @return void
	 */
	public function __construct(CollectionInterface $collection)
	{
		$this->collection = $collection;
	}

	public function getRaw()
	{
		return $this->getCollection()->getRaw();
	}
    
    /**
     * Get collection.
     *
     * @access public
     * @return collection
     */
    public function getCollection()
    {
        return $this->collection;
    }
    
    /**
     * Set collection.
     *
     * @access public
     * @param collection the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setCollection(CollectionInterface $collection)
    {
        $this->collection = $collection;
        return $this;
    }

	/**
	 * toArray 
	 * 
	 * @access public
	 * @return void
	 */
	public function toArray()
    {
        return $this->getCollection()->toArray();
    }

	/**
	 * clear 
	 * 
	 * @access public
	 * @return void
	 */
	public function clear()
    {
        return $this->getCollection()->clear();
    }

	// Set Functionalities
	/**
	 * has 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function has($value)
    {
        return $this->getCollection()->has($value);
    }

	/**
	 * getValues 
	 * 
	 * @access public
	 * @return void
	 */
	public function getValues()
    {
        return $this->getCollection()->getValues();
    }

	/**
	 * add 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function add($value)
    {
        return $this->getCollection()->add($value);
    }

	/**
	 * remove 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function remove($value)
    {
        return $this->getCollection()->remove($value);
    }

	// AliasedMap Functionalities
	/**
	 * hasKey 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function hasKey($key)
    {
        return $this->getCollection()->hasKey($key);
    }

	/**
	 * set 
	 * 
	 * @param mixed $key 
	 * @param mixed $vlaue 
	 * @access public
	 * @return void
	 */
	public function set($key, $vlaue)
    {
        return $this->getCollection()->set($key, $vlaue);
    }

	/**
	 * getKeys 
	 * 
	 * @access public
	 * @return void
	 */
	public function getKeys()
    {
        return $this->getCollection()->getKeys();
    }

	/**
	 * get 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function get($key)
    {
        return $this->getCollection()->get($key);
    }

	/**
	 * removeByKey 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function removeByKey($key)
    {
        return $this->getCollection()->removeByKey($key);
    }

	/**
	 * count 
	 * 
	 * @access public
	 * @return void
	 */
	public function count()
	{
		return count($this->getCollection());
	}

	public function getIterator()
	{
		return $this->getCollection()->getIterator();
	}

	/**
	 * filter 
	 * 
	 * @param \Closure $callback 
	 * @access public
	 * @return void
	 */
	public function filter(\Closure $closure)
	{
		$this->getCollection()->filter($closure);
	}

	/**
	 * map 
	 * 
	 * @param \Closure $closure 
	 * @access public
	 * @return void
	 */
	public function map(\Closure $closure) 
	{
		$this->getCollection()->map($closure);
	}
}

