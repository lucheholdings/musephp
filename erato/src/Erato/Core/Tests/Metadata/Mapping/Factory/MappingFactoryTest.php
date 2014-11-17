<?php
namespace Erato\Core\Tests\Metadata\Mapping\Factory;

use Clio\Component\Pce\Metadata\BasicClassMetadataFactory;

abstract class MappingFactoryTest extends \PHPUnit_Framework_TestCase
{
	private $classMetadataFactory;

	public function testCreate()
	{
		$factory = $this->getFactory();
		$metadata = $this->getMetadata();

		$mapping = $factory->createMapping($metadata);

		$this->assertInstanceof($this->getMappingClass(), $mapping);
	}

	abstract protected function getMetadata();

	abstract protected function getMappingClass();

	abstract protected function getFactory();

	public function createClassMetadata($class)
	{
		return $this->getClassMetadataFactory()->createClassMetadata($class);
	}

	protected function getClassMetadataFactory()
	{
		if(!$this->classMetadataFactory) {
			$this->classMetadataFactory = new BasicClassMetadataFactory();
		}
		return $this->classMetadataFactory;
	}
}

