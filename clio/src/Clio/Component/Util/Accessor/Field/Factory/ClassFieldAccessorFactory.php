<?php
namespace Clio\Component\Util\Accessor\Field\Factory;

use Clio\Component\Util\Accessor\Field\FieldAccessorFactory;

/**
 * ClassFieldAccessorFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface ClassFieldAccessorFactory extends FieldAccessorFactory 
{
	/**
	 * createClassFieldAccessor 
	 * 
	 * @param \ReflectionClass $classReflecctor 
	 * @param mixed $fieldName 
	 * @access public
	 * @return void
	 */
	function createClassFieldAccessor(\ReflectionClass $classReflecctor, $fieldName, array $options = array());

	/**
	 * isSupportedClassField 
	 * 
	 * @param \ReflectionClass $classReflector 
	 * @param mixed $fieldName 
	 * @access public
	 * @return void
	 */
	function isSupportedClassField(\ReflectionClass $classReflector, $fieldName);
}

