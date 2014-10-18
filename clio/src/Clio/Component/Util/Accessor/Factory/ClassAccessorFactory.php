<?php
namespace Clio\Component\Util\Accessor\Factory;

/**
 * ClassAccessorFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface ClassAccessorFactory
{
	/**
	 * createClassAccessor 
	 * 
	 * @param mixed $class 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	function createClassAccessor($class, array $options = array());
}

