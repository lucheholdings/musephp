<?php
namespace Clio\Component\IO\Format;

/**
 * Dumper 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Dumper
{
	/**
	 * dump 
	 * 
	 * @param mixed $context 
	 * @access public
	 * @return void
	 */
	function dump($context);

	/**
	 * isSupportedFormat 
	 * 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	function isSupportedFormat($format);
}

