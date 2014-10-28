<?php
namespace Clio\Component\Util\Container\Collection;

use Clio\Component\Util\Container\Collection as CollectionInterface;

/**
 * Collection
 *   Collection is a pool of values which similar with Map, but can alias the value if you wan.
 *   With alias, it can be used get/set. 
 *   Also different from Map, collection accept duplicated value.
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class Collection extends AbstractCollection implements CollectionInterface, \Serializable
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
		$this->values = $values;

		$this->initContainer();
	}

	/**
	 * initContainer 
	 *    
	 * @access protected
	 * @return void
	 */
	protected function initContainer()
	{
		/* Initialize class definition and more */
	}

	/**
	 * getRaw 
	 * 
	 * @access public
	 * @return void
	 */
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
		if(empty($key)) 
			$this->values[] = $value;
		else 
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
			return $this->removeByKey($key);
		}

		return false;
	}

	public function find($value)
	{
		return array_search($value, $this->values, true);
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
	 * filter 
	 * 
	 * @param \Closure $callback 
	 * @access public
	 * @return void
	 */
	public function filter(\Closure $closure)
	{
		if(!empty($this->values)) {
			$this->values = array_filter($this->values, $closure);
		}
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
		if(!empty($this->values)) {
			$this->values = array_map($closure, $this->values);
		}
	}
}

