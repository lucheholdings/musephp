<?php
namespace Clio\Component\Pce\FieldAccessor\Mapping\Factory;

use Clio\Component\Pce\FieldAccessor\Mapping\ClassMapping;

/**
 * FieldMappingFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface FieldMappingFactory
{
	/**
	 * createFieldMappings 
	 * 
	 * @param ClassMapping $classMapping 
	 * @access public
	 * @return void
	 */
	function createFieldMappings(ClassMapping $classMapping);

	/**
	 * createFieldMapping 
	 * 
	 * @param ClassMapping $classMapping 
	 * @param mixed $fieldName 
	 * @access public
	 * @return void
	 */
	function createFieldMapping(ClassMapping $classMapping, $fieldName);
}

