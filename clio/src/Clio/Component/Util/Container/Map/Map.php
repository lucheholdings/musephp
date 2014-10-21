<?php
namespace Clio\Component\Util\Container\Map;

use Clio\Component\Util\Container\Map as MapInterface;
use Clio\Component\Util\Container\AbstractContainer;

/**
 * Map
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class Map extends AbstractContainer implements MapInterface, \Serializable
{
	/**
	 * values
	 * 
	 * @var mixed
	 * @access protected
	 */
	private $values = array();

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(array $values = array())
	{
		$this->init();

		$this->values = $values;
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

	public function getRaw()
	{
		return $this->values;
	}

	/**
	 * toArray
	 *   Get collection pool
	 * @access public
	 * @return void
	 */
	public function toArray()
	{
		return $this->values;
	}

	/**
	 * getKeys 
	 *   Get all aliases or numeric index of the elements
	 * @access public
	 * @return void
	 */
	public function getKeys()
	{
		return array_keys($this->values);
	}

	/**
	 * getValues 
	 *   Get all values in collection pool 
	 * @access public
	 * @return void
	 */
	public function getValues()
	{
		return array_values($this->values);
	}

	/**
	 * clear
	 *   Remove all values in collection pool 
	 * @access public
	 * @return void
	 */
	public function clear()
	{
		$this->values = array();
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
		if(!$key || empty($key)) {
			throw new \Clio\Component\Exception\InvalidArgumentException('Map requires key to set value.');
		}

		if($this->hasKeyValidator()) {
			$key = $this->getKeyValidator()->validate($key);
		}
		if($this->hasValueValidator()) {
			$value = $this->getValueValidator()->validate($value);
		}

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
	 *   Remove aliased value from collection pool.
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function remove($key)
	{
		if(!array_key_exists($key, $this->values)) {
			throw new \Clio\Component\Exception\InvalidArgumentException(sprintf('Key "%s" is not exists', $key));
		}
		$removed = $this[$key];
		unset($this->values[$key]);

		return $removed;
	}

	/**
	 * merge 
	 * 
	 * @param Map $map 
	 * @access public
	 * @return void
	 */
	public function merge(Map $map)
	{
		foreach($map as $key => $value) {
			$this->set($key, $value);
		}
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
		return $this->remove($key);
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

	/**
	 * getKeyValueArray 
	 * 
	 * @access public
	 * @return void
	 */
	public function getKeyValueArray()
	{
		return $this->values;
	}
}

