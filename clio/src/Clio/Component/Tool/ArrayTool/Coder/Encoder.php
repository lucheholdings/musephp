<?php
namespace Clio\Component\Tool\ArrayTool\Coder;

/**
 * Encoder 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Encoder extends Coder
{
	/**
	 * encode 
	 * 
	 * @param array $data 
	 * @access public
	 * @return void
	 */
	function encode(array $data);
}

