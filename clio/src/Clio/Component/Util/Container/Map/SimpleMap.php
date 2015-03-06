<?php
namespace Clio\Component\Util\Container\Map;

use Clio\Component\Util\Container\Map as MapInterface;
use Clio\Component\Util\Container\AbstractContainer;
/**
 * SimpleMap 
 * 
 * @uses MapInterface
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SimpleMap extends AbstractContainer implements MapInterface 
{
	/**
	 * getKeys 
	 * 
	 * @access public
	 * @return void
	 */
	public function getKeys()
	{
		return array_keys($this->values);
	}

	/**
	 * getValues 
	 * 
	 * @access public
	 * @return void
	 */
	public function getValues()
	{
		return array_values($this->values);
	}

	/**
	 * getKeyValues 
	 * 
	 * @access public
	 * @return void
	 */
	public function getKeyValues()
	{
		return $this->values;
	}

	public function setKeyValues(array $values)
	{
		$this->values = array();

		foreach($values as $key => $value) {
			$this->set($key, $value);
		}
	}

	/**
	 * has 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function has($key)
	{
		return isset($this->values[$key]);
	}

	/**
	 * set 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($key, $value)
	{
		$this->values[$key] = $value;
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
		return $this->values[$key];
	}

	/**
	 * remove 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function remove($key)
	{
		unset($this->values[$key]);
	}

	public function toArray()
	{
		return $this->values;
	}

	public function clear()
	{
		$this->values = array();
	}

	public function count()
	{
		return count($this->values);
	}

	public function getIterator()
	{
		return new ArrayIterator($this->values);
	}

	public function offsetGet($key)
	{
		$this->get($key);
	}

	public function offsetSet($key, $value)
	{
		$this->set($key, $value);
	}

	public function offsetUnset($key)
	{
		$this->remove($key);
	}

	public function offsetExists($key)
	{
		$this->hasKey($key);
	}

	public function serialize()
	{
		return serialize($this->getKeyValues());
	}

	public function unserialize($data)
	{
		$data = unserialize($data);

		$this->setKeyValues($data);
	}
}

