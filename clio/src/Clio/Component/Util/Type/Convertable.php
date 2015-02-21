<?php
namespace Clio\Component\Util\Type;

/**
 * Convertable 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Convertable 
{
	/**
	 * convertData 
	 * 
	 * @param mixed $data 
	 * @param Type $data 
	 * @access public
	 * @return void
	 * @throw Clio\Component\Exception\UnsupportedException 
	 */
	function convertData($data, Type $data);
}

