<?php
namespace Clio\Component\Tool\Schemifier\Factory;

use Clio\Component\Tool\Schemifier\FieldMapperRegistry;
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

	function setFieldMapperRegistry(FieldMapperRegistry $registry);

	function getFieldMapperRegistry();
}

