<?php
namespace Clio\Component\Util\Container;

/**
 * Set 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Set extends Container
{
	/**
	 * toArray 
	 *   Convert to Array 
	 * @access public
	 * @return void
	 */
	function toArray();

	/**
	 * clear 
	 * 
	 * @access public
	 * @return void
	 */
	function clear();

	/**
	 * getAll
	 *   Get values
	 * @access public
	 * @return void
	 */
	function getValues();

	/**
	 * add
	 * 
	 * @param mixed $value
	 * @access public
	 * @return void
	 */
	function add($value);

	/**
	 * contains 
	 * 
	 * @param mixed $value
	 * @access public
	 * @return void
	 */
	function contains($value);

	/**
	 * remove
	 * 
	 * @param mixed $value
	 * @access public
	 * @return void
	 */
	function remove($value);
}

