<?php
namespace Clio\Component\Container\ArrayImpl;

class Map extends AbstractContainer implements MapInterface 
{
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

