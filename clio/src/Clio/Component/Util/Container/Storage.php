<?php
namespace Clio\Component\Util\Container;

/**
 * Storage 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Storage extends \Countable
{
	
	/**
	 * load
	 *   Load from storage. 
	 * 
	 * @access public
	 * @return void
	 */
	function load();

	/**
	 * save 
	 *   Save into storage. 
	 * 
	 * @access public
	 * @return void
	 */
	function save();
}

