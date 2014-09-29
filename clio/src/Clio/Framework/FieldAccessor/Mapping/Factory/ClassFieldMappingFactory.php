<?php
namespace Clio\Framework\FieldAccessor\Mapping\Factory;

use Clio\Component\Pce\FieldAccessor\Mapping\ClassMapping;
use Clio\Component\Pce\FieldAccessor\Mapping\Factory\BasicFieldMappingFactory;

/**
 * ClassFieldMappingFactory 
 * 
 * @uses BasicFieldMappingFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ClassFieldMappingFactory extends BasicFieldMappingFactory
{

	/**
	 * createFieldMapping 
	 * 
	 * @param ClassMapping $classMapping 
	 * @param mixed $fieldname 
	 * @access protected
	 * @return void
	 */
	public function createFieldMapping(ClassMapping $classMapping, $fieldname)
	{
		$mapping = parent::createFieldMapping($classMapping, $fieldname);

		if(($fieldname == 'tags') && $classMapping->getReflectionClass()->implementsInterface('Clio\Component\Util\Tag\TagContainerAware')) {
			$mapping->setAccessType('tags');
		} else if(($fieldname == 'attributes') && $classMapping->getReflectionClass()->implementsInterface('Clio\Component\Util\Attribute\AttributeContainerAware')) {
			$mapping->setSkipField(true);
		} 

		return $mapping;
	}
}

