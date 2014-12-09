<?php
namespace Clio\Component\Util\Format;

/**
 * MimeFormat 
 * 
 * @uses Format
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface MimeFormat extends Format
{
	/**
	 * isValidContentType
	 * 
	 * @param mixed $extension 
	 * @access public
	 * @return bool
	 */
	function isValidContentType($contentType);

	/**
	 * getContentType
	 * 
	 * @access public
	 * @return void
	 */
	function getContentType();
}

