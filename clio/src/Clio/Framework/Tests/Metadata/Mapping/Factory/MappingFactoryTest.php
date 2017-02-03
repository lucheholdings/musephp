<?php
namespace Clio\Framework\Tests\Metadata\Mapping\Factory;

use Clio\Component\Pce\Metadata\BasicClassMetadataFactory;

abstract class MappingFactoryTest extends \PHPUnit_Framework_TestCase
{
	private $classMetadataFactory;

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

