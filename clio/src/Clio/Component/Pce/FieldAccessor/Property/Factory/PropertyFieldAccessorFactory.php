<?php
namespace Clio\Component\Pce\FieldAccessor\Property\Factory;

use Clio\Component\Pce\FieldAccessor\Mapping\ClassMapping;

/**
 * PropertyFieldAccessorFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface PropertyFieldAccessorFactory
{
	/**
	 * createPropertyFieldAccessor 
	 * 
	 * @param ClassMapping $classMapping 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	function createPropertyFieldAccessor(ClassMapping $classMapping, $field);
}

