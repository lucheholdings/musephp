<?php
namespace Clio\Component\Util\Injection;

/**
 * Injector 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Injector
{
	/**
	 * inject 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	function inject($object);
}

