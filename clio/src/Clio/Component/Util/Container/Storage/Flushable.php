<?php
namespace Clio\Component\Conatiner\Storage\Flushable;

/**
 * Flushable 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Flushable
{
	/**
	 * flush 
	 *   Remove all data from storage 
	 * @access public
	 * @return void
	 */
	function flush();
}

