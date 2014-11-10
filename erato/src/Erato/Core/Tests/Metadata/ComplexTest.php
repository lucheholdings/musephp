<?php
namespace Erato\Core\Tests\Metadata;

use Erato\Core\Tests\FrameworkTestCase;

use Erato\Core\Tests\DummySchemifierFactory;



use Erato\Core\Tests\Models;

class ComplexTest extends FrameworkTestCase
{
	public function testSuccess()
	{
		$factory = $this->getClassMetadataFactory();

		$model = new Models\TestModel01();

		$classMetadata = $this->createClassMetadata($model);

		$mappings = $classMetadata->getMappings();

		//$this->assertArrayHasKey('field_accessor', $mappings);
		$this->assertArrayHasKey('schemifier', $mappings);

	}
}

