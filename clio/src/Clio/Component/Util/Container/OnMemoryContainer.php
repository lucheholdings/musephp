<?php
namespace Clio\Component\Util\Container;

class OnMemoryContainer implements 
	Container, 
	\IteratorAggregate,
	\Serializable
{
	private $values;

	public function __construct(array $values)
	{
		$this->values = $values;
	}

	public function setRaw(array $values)
	{
		$this->values = $values;
	}

	public function getRaw()
	{
		return $this->values;
	}

	public function count()
	{
		return count($this->values);
	}

	public function getIterator()
	{
		return new \ArrayIterator($this->values);
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

