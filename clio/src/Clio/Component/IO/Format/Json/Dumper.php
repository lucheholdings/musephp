<?php
namespace Clio\Component\IO\Format\Json;

use Clio\Component\IO\Format\Dumper as DumperInterface;

/**
 * Dumper 
 * 
 * @uses DumperInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Dumper implements DumperInterface 
{
	/**
	 * dump 
	 * 
	 * @param mixed $content 
	 * @access public
	 * @return void
	 */
	public function dump($content)
	{
		return json_encode($content);
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

