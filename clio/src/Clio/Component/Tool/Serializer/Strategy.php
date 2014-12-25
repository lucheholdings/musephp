<?php
namespace Clio\Component\Tool\Serializer;

/**
 * Strategy 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Strategy
{
	/**
	 * getSupportFormats 
	 * 
	 * @access public
	 * @return void
	 */
	function getSupportFormats();
}

