<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Component\Counter;

interface CounterMap extends Counter 
{
	/**
	 * count 
	 * 
	 * @param mixed $key
	 * @access public
	 * @return void
	 */
	function count($key = null);

	/**
	 * reset 
	 * 
	 * @param mixed $key
	 * @access public
	 * @return void
	 */
	function reset($key = null);

	/**
	 * increment 
	 * 
	 * @param mixed $key
	 * @access public
	 * @return void
	 */
	function increment($key = null);

	/**
	 * decrement 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	function decrement($key = null);
}

