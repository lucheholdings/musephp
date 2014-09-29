<?php
namespace Clio\Component\Pce\FieldAccessor\Mapping\Factory;

use Clio\Component\Pce\FieldAccessor\Mapping\ClassMapping,
	Clio\Component\Pce\FieldAccessor\Mapping\BasicClassMapping,
	Clio\Component\Pce\FieldAccessor\Mapping\PropertyFieldMapping,
	Clio\Component\Pce\FieldAccessor\Mapping\FieldMapping;

/**
 * BasicMappingFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class BasicMappingFactory 
{
	/**
	 * createFieldMappings 
	 * 
	 * @param \ReflectionClass $class 
	 * @access public
	 * @return void
	 */
	public function createClassMapping(\ReflectionClass $reflector)
	{
		$mapping = new BasicClassMapping($reflector);


		return $mapping;
	}

	/**
	 * createFieldMapping 
	 * 
	 * @param ClassMapping $classMapping 
	 * @param mixed $fieldname 
	 * @access public
	 * @return void
	 */
	public function createFieldMapping(ClassMapping $classMapping, $fieldname)
	{
		if($classMapping->getReflectionClass()->hasProperty($fieldname)) {
			return new PropertyFieldMapping($classMapping, $fieldname, $fieldname);
		} else {
			return new BasicFieldMapping($classMapping, $fieldname);
		}
	}
}

