<?php
namespace Clio\Component\Pce\Injection;

/**
 * ObjectInjection 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface ObjectInjection
{
	/**
	 * inject 
	 * 
	 * @param \Object $object 
	 * @access public
	 * @return void
	 */
	function inject($object);
}

