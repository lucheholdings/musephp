<?php
namespace Clio\Extra\Tests\Type\Factory;

use Clio\Extra\Tests\TestSchemaRegistry;
use Clio\Component\Metadata;
use Clio\Extra\Type\Factory\SchemaMetadataTypeFactory;

class SchemaMetadataTypeFactoryTest extends \PHPUnit_Framework_TestCase 
{
    public function testCreate()
    {
        $factory = new SchemaMetadataTypeFactory(new Metadata\Resolver\RegisteredResolver(new TestSchemaRegistry()));

        $type = $factory->createType('Clio\Component\Type\Tests\Models\Foo');
        $this->assertInstanceof('Clio\Extra\Type\SchemaMetadataType', $type);
        $this->assertTrue($type->isType('Clio\Component\Type\Tests\Models\Foo'));

        $type = $factory->createType('Clio\Component\Type\Tests\Models\FooInterface');
        $this->assertInstanceof('Clio\Extra\Type\SchemaMetadataType', $type);
        $this->assertTrue($type->isType('Clio\Component\Type\Tests\Models\FooInterface'));
    }
}

