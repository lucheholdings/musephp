<?php
namespace Clio\Component\Format\Json;

use Clio\Component\Format\Parser as ParserInterface;
use Clio\Component\Format\Exception\UnsupportedFormatException;

/**
 * Parser 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class Parser implements ParserInterface
{
	/**
	 * parse 
	 * 
	 * @param mixed $content 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	public function parse($content)
	{
		return json_decode($content, true);
	}

	/**
	 * isSupportedFormat 
	 * 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	public function isSupportedFormat($format)
	{
		return 'json' === $format;
	}
}

