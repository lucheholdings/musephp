<?php
namespace Clio\Component\Util\Metadata\Factory;

use Clio\Component\Util\Metadata\Schema\ClassMetadata;
use Clio\Component\Util\Metadata\Field\PropertyMetadata;
use Clio\Component\Util\Metadata\Mapping\Factory\FactoryCollection;
use Clio\Component\Util\Metadata\Mapping\MappingCollection;
use Clio\Component\Util\Metadata\SchemaMetadata;

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
		if(is_string($schema) && class_exists($schema)) {
			$schema = new \ReflectionClass($schema);
		}

		if(!$schema instanceof \ReflectionClass) {
			throw new \InvalidArgumentException('ClassMetadataFactory only accept ReflectionClass or an existing class name.');
		}

		$schemaMetadata = new ClassMetadata($schema);

		// Create Fields for default class properties 
		foreach($schema->getProperties() as $property) {
			$schemaMetadata->addField($this->createFieldMetadata($schemaMetadata, $property->getName()));
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
	protected function doCreateFieldMetadata(SchemaMetadata $schema, $fieldName)
	{
		return new PropertyMetadata($schema, $fieldName);
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedSchema($schema)
	{
		return ($schema instanceof \ReflectionClass) || (is_string($schema) && class_exists($schema));
	}
}

