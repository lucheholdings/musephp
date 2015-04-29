<?php
namespace Clio\Component\Container\ArrayImpl;

use Clio\Component\Container\Set as SetInterface;

/**
 * Set 
 * 
 * @uses AbstractContainer
 * @uses SetInterface
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Set extends AbstractContainer implements SetInterface 
{
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
        return $this;
	}

    /**
     * has 
     * 
     * @param mixed $value 
     * @access public
     * @return void
     */
	public function has($value)
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
		$this->values = array_filter($this->values, function($v) use ($value) {
				return !($value == $v);
			});
	}
}

