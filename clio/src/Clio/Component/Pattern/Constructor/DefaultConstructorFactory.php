<?php
namespace Clio\Component\Pattern\Constructor;

/**
 * DefaultConstructorFactory 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class DefaultConstructorFactory 
{
	/**
	 * createConstructor 
	 * 
	 * @param \ReflectionClass $classReflector 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function createConstructor(\ReflectionClass $classReflector)
	{
		if($classReflector->hasMethod('__construct')) {
			return new ConstructConstructor();
		} else {
			return new NoConstructConstructor();
		}
	}
}

