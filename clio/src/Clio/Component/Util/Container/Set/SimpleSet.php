<?php
namespace Clio\Component\Util\Container\Set;

use Clio\Component\Util\Container\Set as SetInterface;

class SimpleSet implements SetInterface 
{
	public function __construct()
	{
		$this->values = array();
	}

	/**
	 * toArray 
	 *   Convert to Array 
	 * @access public
	 * @return void
	 * @deprecated
	 */
	public function toArray()
	{
		return array_values($this->values);
	}

	/**
	 * clear 
	 * 
	 * @access public
	 * @return void
	 */
	public function clear()
	{
		$this->values = array();
	}

	/**
	 * getAll
	 *   Get values
	 * @access public
	 * @return void
	 */
	public function getValues()
	{
		return array_values($this->values);
	}

	/**
	 * add
	 * 
	 * @param mixed $value
	 * @access public
	 * @return void
	 */
	public function add($value)
	{
		// Set keep the value unique
		if(!in_array($value, $this->values)) {
			$this->values[] = $value;
		}
	}

	/**
	 * contains 
	 * 
	 * @param mixed $value
	 * @access public
	 * @return void
	 */
	public function contains($value)
	{
		return in_array($value, $this->values);
	}

	/**
	 * remove
	 * 
	 * @param mixed $value
	 * @access public
	 * @return void
	 */
	public function remove($value)
	{
		$this->values = array_filter($this->array, function($v) {
				return !($value == $v)
			});
	}
}

