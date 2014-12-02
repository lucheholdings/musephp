<?php
namespace Clio\Component\Util\Format;

/**
 * FileFormat 
 * 
 * @uses Format
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface FileFormat extends Format
{
	/**
	 * validateExtension 
	 * 
	 * @param mixed $extension 
	 * @access public
	 * @return bool
	 */
	function validateExtension($extension);

	/**
	 * getFileExtension 
	 * 
	 * @access public
	 * @return void
	 */
	function getFileExtension();
}

