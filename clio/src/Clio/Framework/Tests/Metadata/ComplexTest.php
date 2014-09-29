<?php
namespace Clio\Framework\Tests\Metadata;

use Clio\Framework\Tests\FrameworkTestCase;

use Clio\Framework\Tests\DummySchemifierFactory;



use Clio\Framework\Tests\Models;

class ComplexTest extends FrameworkTestCase
{
	public function testSuccess()
	{
		$factory = $this->getClassMetadataFactory();

		$model = new Models\TestModel01();
	
		$classMetadata = $this->createClassMetadata($model);

		$mappings = $classMetadata->getMappings();
		$this->assertArrayHasKey('field_accessor', $mappings);
		$this->assertArrayHasKey('schemifier', $mappings);

	}
}

