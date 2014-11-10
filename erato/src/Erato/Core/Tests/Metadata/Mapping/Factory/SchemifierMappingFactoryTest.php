<?php
namespace Erato\Core\Tests\Metadata\Mapping\Factory;

use Erato\Core\Metadata\Mapping\Factory\SchemifierMappingFactory;
use Erato\Core\Tests\DummySchemifierFactory;

use Erato\Core\Tests\Models;

class SchemifierMappingFactoryTest extends MappingFactoryTest
{
	public function testCreateMapping()
	{
		$schemifierFactory = new DummySchemifierFactory(); 
		$mappingFactory = new SchemifierMappingFactory($schemifierFactory); 

		$model = new Models\TestModel01();
		$mapping = $mappingFactory->createMapping($this->createClassMetadata($model));

		$this->assertInstanceOf('Erato\Core\Metadata\Mapping\SchemifierMapping', $mapping);
		$this->assertInstanceof('Erato\Core\Tests\DummySchemifier', $mapping->getSchemifier());
	}
}

