<?php
namespace Clio\Component\Util\Container\Storage;

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
class ArrayStorage implements RandomAccessable, SequencialAccessable, SetAccessable, \Serializable, \Countable
{
	/**
	 * {@inheritdoc}
	 */
	private $values = array();

	// Storage Methods
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
		return array_key_exists($key, $this->values);
    }

	/**
	 * {@inheritdoc}
	 */
	public function getAt($key)
	{
		return $this->values[$key];
	}

	/**
	 * {@inheritdoc}
	 */
	public function insertAt($key, $value)
	{
		$this->values[$key] = $value;
	}

	/**
	 * {@inheritdoc}
	 */
	public function removeAt($key)
	{
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

