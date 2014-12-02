<?php
namespace Clio\Component\Pattern\Loader;

/**
 * Parser 
 *   Parser is an interface of Data Parser which commonize the data format which loaded
 *   by Loader.
 *  
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Parser 
{
	/**
	 * parser 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	function parse($data);
}

