<?php
namespace Clio\Component\Tool\Schemifier;

/**
 * Schemifier 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Schemifier
{
	/**
	 * schemify 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	function schemify($data);

	/**
	 * getSchemeClass 
	 * 
	 * @access public
	 * @return ReflectionClass
	 */
	function getSchemeClass();
}

