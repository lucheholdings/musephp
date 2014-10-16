<?php
namespace Clio\Component\Util\FieldAccessor\Mapping\Factory;

use Clio\Component\Util\FieldAccessor\Mapping\ClassMapping;
use Clio\Component\Util\FieldAccessor\Mapping\BasicFieldMapping,
	Clio\Component\Util\FieldAccessor\Mapping\PropertyFieldMapping;

use Clio\Component\Util\Psr\Psr1;

/**
 * BasicFieldMappingFactory 
 * 
 * @uses FieldMappingFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class BasicFieldMappingFactory implements FieldMappingFactory
{
	/**
	 * createFieldMappings 
	 * 
	 * @param ClassMapping $classMapping 
	 * @access public
	 * @return void
	 */
	public function createFieldMappings(ClassMapping $classMapping)
	{
		$fields = array();
		foreach($classMapping->getReflectionClass()->getProperties() as $property) {
			$field = $this->createFieldMapping($classMapping, $property->getName());

			if($field) {
				$fields[$property->getName()] = $field;
			}
		}
		return $fields;
	}

	/**
	 * createFieldMapping 
	 * 
	 * @param ClassMapping $classMapping 
	 * @param mixed $fieldName 
	 * @access public
	 * @return void
	 */
	public function createFieldMapping(ClassMapping $classMapping, $fieldname)
	{
		if('_' == $fieldname[0]) {
			// skip
			$mapping = null; 
		} else if($classMapping->getReflectionClass()->hasProperty($fieldname)) {
			$mapping = new PropertyFieldMapping($classMapping, $fieldname, $fieldname);
			$mapping->setAccessType($mapping->getReflectionProperty()->isPublic() ? 'public_property' : 'method');
		} else {
			$mapping = new BasicFieldMapping($classMapping, $fieldname);

			$mapping->setAccessType('method');
		}

		if($mapping && ('method' == $mapping->getAccessType())) {
			$reflectionClass = $classMapping->getReflectionClass();
			$mapping->setGetterMethod($this->detectDefaultGetter($reflectionClass, $fieldname));
			$mapping->setSetterMethod($this->detectDefaultSetter($reflectionClass, $fieldname));
		}

		return $mapping;
	}

	/**
	 * detectDefaultSetter 
	 * 
	 * @param \ReflectionClass $class 
	 * @param mixed $fieldName 
	 * @access protected
	 * @return void
	 */
	protected function detectDefaultSetter(\ReflectionClass $class, $fieldName)
	{
		$method = Psr1::formatMethodName('set ' . $fieldName);

		if(!$class->hasMethod($method)) {
			$method = null;
		}

		return $method;
	}

	protected function detectDefaultGetter(\ReflectionClass $class, $fieldName)
	{
		$method = $getMethod = Psr1::formatMethodName('get ' . $fieldName);

		if(!$class->hasMethod($method)) {
			$method = $isMethod = Psr1::formatMethodName('is ' . $fieldName);
			if(!$class->hasMethod($method)) {
				$method = null;
			}
		}

		return $method;
	}
}

