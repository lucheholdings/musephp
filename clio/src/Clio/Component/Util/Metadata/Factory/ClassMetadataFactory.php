<?php
namespace Clio\Component\Util\Metadata\Factory;

use Clio\Component\Util\Metadata\Schema\ClassMetadata;
use Clio\Component\Util\Metadata\Field\PropertyMetadata;
use Clio\Component\Util\Metadata\Mapping\Factory\FactoryCollection;
use Clio\Component\Util\Metadata\Mapping\MappingCollection,
	Clio\Component\Util\Metadata\Mapping\LazyMappingCollection
;

/**
 * ClassMetadataFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ClassMetadataFactory extends SchemaMetadataFactory 
{
	/**
	 * doCreateMetadata 
	 * 
	 * @param mixed $schema 
	 * @access protected
	 * @return void
	 */
	protected function doCreateMetadata($schema)
	{
		if(!$schema instanceof \ReflectionClass) {
			throw new \InvalidArgumentException();
		}

		$schemaMetadata = new ClassMetadata($schema);

		// 
		foreach($schema->getProperties() as $property) {
			$schemaMetadata->addField($this->createFieldMetadata($property));
		}

		return $schemaMetadata;
	}

	/**
	 * doCreateFieldMetadata 
	 * 
	 * @param mixed $field 
	 * @access protected
	 * @return void
	 */
	protected function doCreateFieldMetadata($field)
	{
		if(!$field instanceof \ReflectionProperty) {
			throw new \InvalidArgumentException('Field has to be an instanceof ReflectionProperty.');
		}

		return new PropertyMetadata($field);
	}
}

