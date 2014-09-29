<?php
namespace Clio\Component\Util\Attribute;

/**
 * AttributeFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface AttributeFactory
{
	/**
	 * createAttribute 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @param mixed $owner 
	 * @access public
	 * @return void
	 */
	function createAttribute($key, $value, $owner = null);
}

