<?php
namespace Clio\Component\Util\Container;

/**
 * Queue 
 * 
 * @uses Container
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Queue extends Container
{
	/**
	 * peek 
	 * 
	 * @access public
	 * @return void
	 */
	function peek();

	/**
	 * enqueue 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function enqueue($value);

	/**
	 * dequeue 
	 * 
	 * @access public
	 * @return void
	 */
	function dequeue();

	/**
	 * count
	 * 
	 * @access public
	 * @return void
	 */
	function count();

}

