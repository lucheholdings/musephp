<?php
namespace Clio\Component\Schemifier\Factory;

/**
 * SchemifierFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface SchemifierFactory
{
	/**
	 * createSchemifier 
	 * 
	 * @param ReflectionClass $reflectionClass
	 * @access public
	 * @return void
	 */
	function createSchemifier($reflectionClass);
}

