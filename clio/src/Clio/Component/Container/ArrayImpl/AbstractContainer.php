<?php
namespace Clio\Component\Container\ArrayImpl;

abstract class AbstractContainer implements \Countable, 
    \IteratorAggregate, 
    \Serializable
{
    /**
     * values 
     * 
     * @var mixed
     * @access protected
     */
    protected $values;

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
	 * init 
	 *    
	 * @access protected
	 * @return void
	 */
	protected function initContainer()
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

