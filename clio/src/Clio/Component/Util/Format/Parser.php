<?php
namespace Clio\Component\Util\Format;

/**
 * Parser 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
interface Parser
{
	/**
	 * parse 
	 * 
	 * @param mixed $content 
	 * @access public
	 * @return void
	 */
	function parse($content);

	/**
	 * isSupportedFormat 
	 * 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	function isSupportedFormat($format);
}

