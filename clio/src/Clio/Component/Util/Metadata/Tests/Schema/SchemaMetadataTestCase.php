<?php
namespace Clio\Component\Util\Metadata\Tests\Schema;

use Clio\Component\Util\Metadata\Field\VirtualFieldMetadata;

class SchemaMetadataTestCase extends \PHPUnit_Framework_TestCase 
{
	public function testName()
	{
		$metadata = $this->createMetadata($this->getTestSchema());

		$this->assertEquals($this->getTestSchemaName(), $metadata->getName());
		$this->assertEquals($this->getTestSchemaName(), (string)$metadata);
	}

	public function testFields()
	{
		$metadata = $this->createMetadata($this->getTestSchema());

		$this->assertEmpty($metadata->getFields());

		$metadata->addField(new VirtualFieldMetadata($metadata, 'hoge'));

		$this->assertCount(1, $metadata->getFields());
	}
}


