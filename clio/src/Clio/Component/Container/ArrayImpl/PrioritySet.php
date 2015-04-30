<?php
namespace Clio\Component\Container\ArrayImpl;

use Clio\Component\Container\PrioritySet as PrioritySetInterface;

/**
 * PrioritySet 
 * 
 * @uses Set
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class PrioritySet extends Set implements PrioritySetInterface
{
    private $_sorted;

    /**
     * getValues 
     * 
     * @access public
     * @return void
     */
	public function getValues()
	{
        if(!$this->_sorted) {
            $values = array();
            foreach($this->values as $priority => $priorityValues) {
                $values = array_merge($values, $priorityValues);
            }
            $this->_sorted = $values;
        } 
        return $this->_sorted;
	}

    /**
     * add 
     * 
     * @param mixed $value 
     * @param int $priority 
     * @access public
     * @return void
     */
	public function add($value, $priority = 0)
	{
		// Set keep the value unique
		if(!in_array($value, $this->values)) {
			$this->values[$priority][] = $value;
		}
        $this->_sorted = null;
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
		return in_array($value, $this->getValues());
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
        $this->values = array_map(function($values) use ($value) {
                return array_filter($values, function($v) use ($value) {
                    return !($value == $v); 
                });
            }, $this->values);

        $this->_sorted = null;
	}

    public function getIterator()
    {
        return new \ArrayIterator($this->getValues());
    }
}

