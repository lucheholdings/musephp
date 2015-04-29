<?php
namespace Clio\Component\Locator;

/**
 * Locator 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Locator
{
	/**
	 * locate 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	function locate($name);
}

