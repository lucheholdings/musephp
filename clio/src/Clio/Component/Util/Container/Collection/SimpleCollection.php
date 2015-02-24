<?php
namespace Clio\Component\Util\Container\Collection;

use Clio\Component\Util\Container\Collection as CollectionInterface;
use Clio\Component\Util\Container\AbstractContainer;

class SimpleCollection extends AbstractContainer implements CollectionInterface 
{
	private $values;

	protected function initContainer(array $defaults)
	{
		$this->values = $defaults;
	}

	public function toArray()
	{
		return $this->values;
	}

	public function clear()
	{
		$this->values = array();
	}

	public function has($value)
	{
		return in_array($value, $this->values);
	}

	public function getValues()
	{
		return array_values($this->values);
	}

	public function add($value)
	{
		$this->values[] = $value;
	}

	public function remove($value)
	{
		$this->values = array_filter($this->values, function($v) use ($value){
				return $v != $value;
			});
	}

	public function hasKey($key)
	{
		return array_key_exists($key, $this->values);
	}

	public function set($key, $value)
	{
		$this->values[$key] = $value;
	}

	public function getKeys()
	{
		return array_keys($this->values);
	}

	public function get($key)
	{
		return $this->values[$key];
	}

	public function removeByKey($key)
	{
		unset($this->values[$key]);
	}

	public function count()
	{
		return count($this->values);
	}

	public function getIterator()
	{
		return new \ArrayIterator($this->values);
	}

	public function offsetGet($key)
	{
		return $this->get($key);
	}

	public function offsetSet($key, $value)
	{
		$this->set($key, $value);
	}

	public function offsetExists($key)
	{
		return $this->hasKey($key);
	}

	public function offsetUnset($key)
	{
		return $this->removeByKey($key);
	}

	public function serialize()
	{
		return serialize($this->values);
	}

	public function unserialize($data)
	{
		$this->values = unserialize($data);
	}
}

