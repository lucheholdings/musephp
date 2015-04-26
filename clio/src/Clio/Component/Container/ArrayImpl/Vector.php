<?php
namespace Clio\Component\Container\ArrayImpl;

/**
 * Vector 
 * 
 * @uses AbstractContainer
 * @uses VectorInterface
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Vector extends AbstractContainer implements VectorInterface 
{
    /**
     * hasKey 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
	public function hasKey($key)
	{
		return array_key_exists($key, $this->values);
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
     * getKeys 
     * 
     * @access public
     * @return void
     */
	public function getKeys()
	{
		return array_keys($this->values);
	}

    /**
     * getValues 
     * 
     * @access public
     * @return void
     */
	public function getValues()
	{
		return array_values($this->values);
	}

    /**
     * get 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
	public function get($key)
	{
		return $this->values[$key];
	}

    /**
     * set 
     * 
     * @param mixed $key 
     * @param mixed $value 
     * @access public
     * @return void
     */
	public function set($key, $value)
	{
		$this->values[$key] = $value;
	}

    /**
     * removeByKey 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
	public function removeByKey($key)
	{
		unset($this->values[$key]);
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
		$this->values = array_filter($this->values, function($v) use ($value){
				return $v != $value;
			});
	}

    /**
     * offsetGet 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
	public function offsetGet($key)
	{
		return $this->get($key);
	}

    /**
     * offsetSet 
     * 
     * @param mixed $key 
     * @param mixed $value 
     * @access public
     * @return void
     */
	public function offsetSet($key, $value)
	{
		$this->set($key, $value);
	}

    /**
     * offsetExists 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
	public function offsetExists($key)
	{
		return $this->hasKey($key);
	}

    /**
     * offsetUnset 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
	public function offsetUnset($key)
	{
		return $this->removeByKey($key);
	}
}

