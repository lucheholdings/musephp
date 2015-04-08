<?php
namespace Clio\Component\Util\Metadata\Tests\Schema;

use Clio\Component\Util\Metadata\Schema\SchemaMetadata;
use Clio\Component\Util\Type as Types;


class SchemaMetadataTestCase extends \PHPUnit_Framework_TestCase 
{
	public function testConstruct()
	{
		$metadata = new SchemaMetadata(new Types\Actual\ClassType('Clio\Component\Util\Type\Tests\Models\Foo'));

        // 
        $this->assertEquals('Clio\Component\Util\Type\Tests\Models\Foo', $metadata->getName());
        $this->assertEquals('Clio\Component\Util\Type\Tests\Models\Foo', (string)$metadata);
        $this->assertInstanceof('Clio\Component\Util\Type\Actual\ClassType', $metadata->getType());

        $this->assertEmpty($metadata->getMappings());
        $this->assertEmpty($metadata->getFields());
        $this->assertFalse($metadata->hasParent());

        $metadata = new SchemaMetadata(new Types\Actual\ArrayType());
        $this->assertEquals('array', $metadata->getName());
        $this->assertInstanceof('Clio\Component\Util\Type\Actual\ArrayType', $metadata->getType());
	}
}


