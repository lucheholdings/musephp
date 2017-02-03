<?php
namespace Clio\Component\Util\Container\Storage;

/**
 * OnMemoryStorage 
 * 
 * @uses Storage
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class OnMemoryStorage 
  implements 
    Dumpable,
	DirectionalStorage,
	RandomAccessStorage
{
	/**
	 * values 
	 * 
	 * @var array
	 * @access private
	 */
	private $values = array();

	/**
	 * load 
	 * 
	 * @access public
	 * @return void
	 */
	public function load()
	{
		throw new \Clio\Component\Exception\RuntimeException('OnMemoryStorage is not support methods load/save.');
	}

	/**
	 * save 
	 * 
	 * @access public
	 * @return void
	 */
	public function save()
	{
		throw new \Clio\Component\Exception\RuntimeException('OnMemoryStorage is not support methods load/save.');
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
	 * addFirst 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function addFirst($value)
	{
		array_unshift($this->values, $value);
	}

	/**
	 * addLast 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function addLast($value)
	{
		return array_push($this->values, $value);
	}

	/**
	 * removeFirst 
	 * 
	 * @access public
	 * @return void
	 */
	public function removeFirst()
	{
		return array_shift($this->values);
	}

	/**
	 * removeLast 
	 * 
	 * @access public
	 * @return void
	 */
	public function removeLast()
	{
		return array_pop($this->values);
	}

	/**
	 * first 
	 * 
	 * @access public
	 * @return void
	 */
	public function first()
	{
		return reset($this->values);
	}

	/**
	 * last 
	 * 
	 * @access public
	 * @return void
	 */
	public function last()
	{
		return end($this->values);
	}

	/**
	 * setAt 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function setAt($key, $value)
	{
		$this->values[$key] = $value;
	}

	/**
	 * getAt 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function getAt($key)
	{
		return $this->values[$key];
	}

	/**
	 * removeAt 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function removeAt($key)
	{
		unset($this->values[$key]);
	}

	/**
	 * existsAt 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function existsAt($key)
	{
		return isset($this->values[$key]);
	}

	/**
	 * dump 
	 * 
	 * @access public
	 * @return void
	 */
	public function dump()
	{
		return $this->values;
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
}

