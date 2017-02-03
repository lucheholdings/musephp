<?php
namespace Clio\Framework\Tests\Metadata\Mapping\Factory;

use Clio\Framework\Metadata\Mapping\Factory\SchemifierMappingFactory;
use Clio\Framework\Tests\DummySchemifierFactory;

use Clio\Framework\Tests\Models;

class SchemifierMappingFactoryTest extends MappingFactoryTest
{
	public function testCreateMapping()
	{
		$schemifierFactory = new DummySchemifierFactory(); 
		$mappingFactory = new SchemifierMappingFactory($schemifierFactory); 

		$model = new Models\TestModel01();
		$mapping = $mappingFactory->createMapping($this->createClassMetadata($model));

		$this->assertInstanceOf('Clio\Framework\Metadata\Mapping\SchemifierMapping', $mapping);
		$this->assertInstanceof('Clio\Framework\Tests\DummySchemifier', $mapping->getSchemifier());
	}
}

