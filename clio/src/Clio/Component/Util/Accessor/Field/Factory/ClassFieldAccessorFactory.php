<?php
namespace Clio\Component\Util\Accessor\Field\Factory;

/**
 * ClassFieldAccessorFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface ClassFieldAccessorFactory 
{
	/**
	 * createClassFieldAccessor 
	 * 
	 * @param \ReflectionClass $classReflecctor 
	 * @param mixed $fieldName 
	 * @access public
	 * @return void
	 */
	function createClassFieldAccessor(\ReflectionClass $classReflecctor, $fieldName);

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

