<?php
namespace Clio\Component\Container\Storage;

use Clio\Component\Container\Storage;

/**
 * ArrayStorage 
 * 
 * @uses RandomAccessable
 * @uses SequencialAccessable
 * @uses SetAccessable
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ArrayStorage implements Storage\Storage, Storage\RandomAccessable, Storage\SequencialAccessable, \Serializable, \Countable
{
	/**
	 * {@inheritdoc}
	 */
	private $values = array();

	public function __construct(array $values = array())
	{
		$this->values = $values;
	}

	// Storage Methods
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
	 * {@inheritdoc}
	 */
	public function toArray()
	{
		return $this->values;
	}

	/**
	 * {@inheritdoc}
	 */
	public function removeAll()
	{
		$this->values = array();
	}

	// SetAccessable
	public function insert($value)
	{
		$this->insertEnd($value);
	}

	/**
	 * {@inheritdoc}
	 */
	public function exists($value)
	{
		return in_array($value, $this->values);
	}

	/**
	 * {@inheritdoc}
	 */
	public function remove($value)
	{
		$index = array_search($value, $this->values);

		if(false !== $index) {
			unset($this->values[$index]);
		}
	}

	// SequencialAccessable Methods
	/**
	 * {@inheritdoc}
	 */
	public function insertBegin($value)
	{
		array_unshift($this->values, $value);
	}

	/**
	 * {@inheritdoc}
	 */
	public function insertEnd($value)
	{
		array_push($this->values, $value);
	}

	/**
	 * {@inheritdoc}
	 */
	public function begin()
	{
		return reset($this->values);
	}

	/**
	 * {@inheritdoc}
	 */
	public function end()
	{
		return end($this->values);
	}

	/**
	 * {@inheritdoc}
	 */
	public function removeBegin()
	{
		return array_shift($this->values);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function removeEnd()
	{
		return array_pop($this->values);
	}

	// RandomAccessable Methods
	/**
	 * {@inheritdoc}
	 */
	public function existsAt($key)
    {
        $key = (string)$key;
		if(!is_string($key) && !is_numeric($key)) {
			throw new \Exception(sprintf('Invalid key type "%s" is given', is_object($key) ? get_class($key) : gettype($key)));
		}
		return array_key_exists($key, $this->values);
    }

	/**
	 * {@inheritdoc}
	 */
	public function getAt($key)
	{
        $key = (string)$key;
		return $this->values[$key];
	}

	/**
	 * {@inheritdoc}
	 */
	public function insertAt($key, $value)
	{
        $key = (string)$key;
		$this->values[$key] = $value;
	}

	/**
	 * {@inheritdoc}
	 */
	public function removeAt($key)
	{
        $key = (string)$key;
		unset($this->values[$key]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function count()
	{
		return count($this->values);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function getIterator($mode = self::ITERATE_FORWARD)
	{
		switch($mode) {
		case self::ITERATE_LIFO:
		case self::ITERATE_BACKWARD:
			return new \ArrayIterator(array_reverse($this->values));
		case self::ITERATE_FIFO:
		case self::ITERATE_FORWARD:
			return new \ArrayIterator($this->values);
		default:
			throw new \InvalidArgumentException(sprintf('Iteration Mode %d is not supported.', $mode));
		}
	}

	public function filter(\Closure $callback)
	{
		$filtered = array_filter($this->values, $callback);
		return new static($filtered);
	}

	public function map(\Closure $callback)
	{
		$mapped = array_map($callback, $this->values); 

		return new static($mapped);
	}

	/**
	 * {@inheritdoc}
	 */
	public function serialize()
	{
		return serialize($this->values);
	}

	/**
	 * {@inheritdoc}
	 */
	public function unserialize($serialized)
	{
		$this->values = unserialize($serialized);
	}
}

