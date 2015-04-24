<?php
namespace Erato\Core\Tests\Schema\Mapping\Factory;

use Clio\Component\Pce\Schema\BasicClassSchemaFactory;

abstract class MappingFactoryTest extends \PHPUnit_Framework_TestCase
{
	private $classSchemaFactory;

	public function testCreate()
	{
		$factory = $this->getFactory();
		$metadata = $this->getSchema();

		$mapping = $factory->createMapping($metadata);

		$this->assertInstanceof($this->getMappingClass(), $mapping);
	}

	abstract protected function getSchema();

	abstract protected function getMappingClass();

	abstract protected function getFactory();

	public function createClassSchema($class)
	{
		return $this->getClassSchemaFactory()->createClassSchema($class);
	}

	protected function getClassSchemaFactory()
	{
		if(!$this->classSchemaFactory) {
			$this->classSchemaFactory = new BasicClassSchemaFactory();
		}
		return $this->classSchemaFactory;
	}
}

