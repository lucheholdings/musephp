<?php
namespace Clio\Component\Util\Metadata\Tests\Factory;

use Clio\Component\Util\Metadata\Schema\Factory\ClassMetadataFactory;
use Clio\Component\Util\Metadata\Mapping\Factory\Collection as FactoryCollection;

use Clio\Component\Util\Metadata\Tests\DummyMappingFactory;

class ClassMetadataFactoryTest extends \PHPUnit_Framework_TestCase 
{
	private $factory;

	private $schema;

	public function testCreate()
	{
		$factory = $this->getFactory();
		$schema = $this->getTestSchema();

		$schemaMetadata = $factory->createMetadata($schema);

		$this->assertInstanceof($this->getMetadataClass(), $schemaMetadata);

		$this->assertEquals($this->getTestSchemaFields(), array_keys($schemaMetadata->getFields()));

		return $schemaMetadata;
	}

	public function testCreateWithMapping()
	{
		$mappingFactories = new FactoryCollection(array(
			'dummy' => new DummyMappingFactory()
		));
		$this->factory = new ClassMetadataFactory($mappingFactories, $mappingFactories);

		$metadata = $this->testCreate();
		
		$this->assertTrue($metadata->getMappings()->hasMapping('dummy'));
		$this->assertTrue($metadata->getField('foo')->getMappings()->hasMapping('dummy'));
	}

	protected function getFactory()
	{
		if(!$this->factory) {
			$this->factory = new ClassMetadataFactory();	
		}

		return $this->factory;
	}

	protected function getTestSchema()
	{
		if(!$this->schema) {
			$this->schema = new \ReflectionClass('Clio\Component\Util\Metadata\Tests\Models\TestModel');
		}
		return $this->schema;
	}

	protected function getMetadataClass()
	{
		return 'Clio\Component\Util\Metadata\Schema\ClassMetadata';
	}

	protected function getTestSchemaFields()
	{
		return array_map(function($property){
				return $property->getName();	
			}, $this->getTestSchema()->getProperties());
	}
}

