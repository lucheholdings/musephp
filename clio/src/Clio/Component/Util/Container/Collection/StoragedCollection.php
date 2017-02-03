<?php
namespace Clio\Component\Util\Container\Collection;

use Clio\Component\Util\Container\Collection as CollectionInterface;

class StoragedCollection extends StoragedContainer implements CollectionInterface
{

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(Storage $storage)
	{
		if(!$storage instanceof RandomAccessStorage) {
			throw new \Clio\Component\Exception\InvalidArgumentException('Storage for Collection has to be an instance of RandomAccessStorage.');
		}

		parent::__construct($storage);
	}

	/**
	 * init 
	 *    
	 * @access protected
	 * @return void
	 */
	protected function init()
	{
		/* Initialize class definition and more */
	}

	/**
	 * toArray
	 *   Get collection pool
	 * @access public
	 * @return void
	 */
	public function toArray()
	{
		if(!$this->getStorage() instanceof Dumpable) {
			throw new \Clio\Component\Exception\RuntimeException('Current storage dose not support dump.');
		}
		return $this->storage->dump();
	}

	/**
	 * getKeys 
	 *   Get all aliases or numeric index of the elements
	 * @access public
	 * @return void
	 */
	public function getKeys()
	{
		return array_keys($this->toArray());
	}

	/**
	 * getValues 
	 *   Get all values in collection pool 
	 * @access public
	 * @return void
	 */
	public function getValues()
	{
		return array_values($this->toArray());
	}
	}

	/**
	 * clear
	 *   Remove all values in collection pool 
	 * @access public
	 * @return void
	 */
	public function clear()
	{
		if(!$this->getStorage() instanceof Flushable) {
			throw new \Clio\Component\Exception\RuntimeException('Storage dose not support flush.');
		}
		$this->values = array();
	}

	/**
	 * add 
	 *   Add value into collection pool.
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function add($value)
	{
		$this->values[] = $value;

		return $this;
	}

	/**
	 * set 
	 *   Add aliased value into collection pool. 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($key, $value)
	{
		$this->values[$key] = $value;

		return $this;
	}

	/**
	 * get 
	 *   Get aliased value from collection pool. 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function get($key)
	{
		if(!array_key_exists($key, $this->values)) {
			throw new \Clio\Component\Exception\InvalidArgumentException(sprintf('Key "%s" is not exists.', (string)$key));
		}
		return $this->values[$key];
	}

	/**
	 * has 
	 *   Check value is existed in collection pool. 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function has($value)
	{
		foreach($this as $elem) {
			if($value == $elem)
				return true;
		}
		return false;
	}

	/**
	 * hasKey 
	 *   Check aliased value is existed in collection pool. 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function hasKey($key)
	{
		return array_key_exists($key, $this->values);
	}

	/**
	 * remove 
	 *   Remove value from collection pool 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function remove($value)
	{
		$key = array_search($value, $this->values, true);

		if(false !== $key) {
			unset($this[$key]);

			return true;
		}

		return false;
	}

	/**
	 * removeByKey 
	 *   Remove aliased value from collection pool.
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function removeByKey($key)
	{
		if(!array_key_exists($key, $this->values)) {
			throw new \Clio\Component\Exception\InvalidArgumentException(sprintf('Key "%s" is not exists', $key));
		}
		$removed = $this->values[$key];
		unset($this->values[$key]);
		return $removed;
	}

	/**
	 * getIterator 
	 * 
	 * @access public
	 * @return void
	 */
	public function getIterator()
	{
		return new \ArrayIterator($this->values);
	}

	/**
	 * count 
	 * 
	 * @access public
	 * @return void
	 */
	public function count()
	{
		return count($this->values);
	}

	/**
	 * offsetExists 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function offsetExists($key)
	{
		return $this->hasKey($key);
	}

	/**
	 * offsetGet 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function offsetGet($key)
	{
		return $this->get($key);
	}

	/**
	 * offsetSet 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function offsetSet($key, $value)
	{
		$this->set($key, $value);
	}

	/**
	 * offsetUnset 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function offsetUnset($key)
	{
		$this->removeByKey($key);
	}

	/**
	 * serialize 
	 * 
	 * @access public
	 * @return void
	 */
	public function serialize()
	{
		return serialize($this->values);
	}

	/**
	 * unserialize 
	 * 
	 * @param mixed $serialized 
	 * @access public
	 * @return void
	 */
	public function unserialize($serialized)
	{
		$this->values = unserialize($serialized);
	}
}

