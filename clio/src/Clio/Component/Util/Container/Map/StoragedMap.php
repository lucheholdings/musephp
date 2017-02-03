<?php
namespace Clio\Component\Util\Container\Map;

use Clio\Component\Util\Container\Map as MapInterface;

use Clio\Component\Util\Container\StoragedContainer;
use Clio\Component\Util\Container\Storage,
	Clio\Component\Util\Container\Storage\RandomAccessStorage,
	Clio\Component\Util\Container\Storage\Dumpable
;

/**
 * StoragedMap 
 * 
 * @uses StoragedContainer
 * @uses Map
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class StoragedMap extends StoragedContainer implements MapInterface
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
			throw new \Clio\Component\Exception\InvalidArgumentException('Storage for Map has to be an instance of RandomAccessStorage.');
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
		return $this->getStorage()->dump();
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
	 *   Get all storage in collection pool 
	 * @access public
	 * @return void
	 */
	public function getValues()
	{
		return array_values($this->toArray());
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

		$this->getStorage()->flush();
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
		$this->getStorage()->setAt($key, $value);

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
		if(!$this->getStorage()->existsAt($key)) {
			throw new \Clio\Component\Exception\InvalidArgumentException(sprintf('Key "%s" is not exists.', (string)$key));
		}
		return $this->getStorage()->getAt($key);
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
		return $this->getStorage()->existsAt($key);
	}

	/**
	 * removeByKey 
	 *   Remove aliased value from collection pool.
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function remove($key)
	{
		if(!$this->getStorage()->existsAt($key)) {
			throw new \Clio\Component\Exception\InvalidArgumentException(sprintf('Key "%s" is not exists', $key));
		}
		$removed = $this->getStorage()->removeAt($key);

		return $removed;
	}

	public function getKeyValueArray()
	{
		return $this->toArray();
	}

	/**
	 * getIterator 
	 * 
	 * @access public
	 * @return void
	 */
	public function getIterator()
	{
		return $this->getStorage()->getIterator();
	}

	/**
	 * count 
	 * 
	 * @access public
	 * @return void
	 */
	public function count()
	{
		return $this->getStorage()->count();
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
		return $this->set($key, $value);
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
		return $this->removeByKey($key);
	}
}

