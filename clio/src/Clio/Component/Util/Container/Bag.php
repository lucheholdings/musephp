<?php
namespace Clio\Component\Util\Container;

use Clio\Component\Util\Container\Storage\ArrayStorage;

class Bag implements \ArrayAccess, \Countable, \IteratorAggregate 
{
	private $values = array();

	public function __construct(array $values = array())
	{
		$this->values = $values;
	}

	public function has($key)
	{
		return isset($this->values[$key]);
	}

	public function get($key, $default = null)
	{
		return isset($this->values[$key])
			? $this->values[$key]
			: $default;
	}

	public function set($key, $value)
	{
		$this->values[$key] = $value;
	}

	public function remove($key)
	{
		unset($this->values);
	}

	public function toArray()
	{
		return $this->values;
	}

	public function getIterator()
	{
		return new \ArrayIterator($this->values);
	}

	public function offsetSet($key, $value)
	{
		return $this->set($key, $value);
	}

	public function offsetGet($key)
	{
		if($this->has($key))
			return $this->get($key);
		throw new \OutOfRangeException(sprintf('Offset "%s" is not exists.', $key));
	}

	public function offsetExists($key)
	{
		return $this->has($key);
	}

	public function offsetUnset($key)
	{
		return $this->remove($key);
	}

	public function count()
	{
		return count($this->values);
	}
}

