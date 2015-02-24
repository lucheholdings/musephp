<?php
namespace Clio\Component\Pattern\Registry;

/**
 * EntryLoader 
 *   Load Entry for specified key. 
 *   
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface EntryLoader
{
	/**
	 * loadEntry 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	function loadEntry($key, array $options = array());

	/**
	 * canLoad 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	function canLoad($key);
}

