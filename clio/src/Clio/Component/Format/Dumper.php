<?php
namespace Clio\Component\Format;

/**
 * Dumper 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Dumper extends FormatSupportable
{
	/**
	 * dump 
	 * 
	 * @param mixed $context 
	 * @access public
	 * @return void
	 */
	function dump($context);
}

