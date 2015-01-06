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
interface Parser extends FormatSupportable
{
	/**
	 * parse 
	 * 
	 * @param mixed $content 
	 * @access public
	 * @return void
	 */
	function parse($content);
}

