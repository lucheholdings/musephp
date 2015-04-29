<?php
namespace Clio\Component\Merger;

/**
 * Merger 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Merger
{
	/**
	 * merge 
	 * 
	 * @param mixed $origin 
	 * @access public
	 * @return void
	 */
	function merge($origin);
}

