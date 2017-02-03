<?php
namespace Clio\Component\Util\Container\Storage;

/**
 * Dumpable 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Dumpable
{
	/**
	 * dump
	 *   dump the stored values 
	 * 
	 * @access public
	 * @return void
	 */
	function dump();
}

