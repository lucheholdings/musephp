<?php
namespace Clio\Component\Tool\ArrayTool\Coder;

/**
 * Decoder 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Decoder extends Coder
{
	/**
	 * decoder 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	function decode($data);
}

