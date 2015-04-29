<?php
namespace Clio\Component\Type;

/**
 * Converter 
 *   Converter is a tool to convert data from source type to destination type. 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Converter
{
	/**
	 * convert 
	 * 
	 * @param Type $from 
	 * @param Type $to 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	function convert(Type $from, Type $to, $data);
}

