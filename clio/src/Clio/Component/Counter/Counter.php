<?php
namespace Clio\Component\Counter;

/**
 * Counter 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Counter
{
	/**
	 * count 
	 * 
	 * @access public
	 * @return void
	 */
	function count();

	/**
	 * reset 
	 * 
	 * @access public
	 * @return void
	 */
	function reset();

	/**
	 * increment 
	 * 
	 * @access public
	 * @return void
	 */
	function increment();

	/**
	 * decrement 
	 * 
	 * @access public
	 * @return void
	 */
	function decrement();
}

