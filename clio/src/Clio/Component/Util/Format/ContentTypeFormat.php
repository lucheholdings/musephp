<?php
namespace Clio\Component\Util\Format;

/**
 * ContentTypeFormat 
 * 
 * @uses Format
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface ContentTypeFormat extends Format
{
	/**
	 * validateContentType
	 * 
	 * @param mixed $extension 
	 * @access public
	 * @return bool
	 */
	function validateContentType($contentType);

	/**
	 * getContentType
	 * 
	 * @access public
	 * @return void
	 */
	function getContentType();
}

