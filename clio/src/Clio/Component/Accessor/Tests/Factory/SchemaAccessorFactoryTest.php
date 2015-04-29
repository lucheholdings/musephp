<?php
namespace Clio\Component\Accessor\Tests\Factory;

use Clio\Component\Accessor\Factory\SchemaAccessorFactory;
use Clio\Component\Type;
use Clio\Component\Metadata;

class SchemaAccessorTest extends \PHPUnit_Framework_TestCase 
{
    public function testBasic()
    {
        $factory = new SchemaAccessorFactory();

        $schemaFactory = new Metadata\Factory\SchemaFactory(
                new Metadata\Resolver\LazyResolver(new Metadata\Resolver\NullResolver()), 
                new Type\Resolver\RegisteredResolver(Type\Registry\Factory::createDefault())
            );
        $schema = $schemaFactory->createSchemaMetadata('Clio\Component\Accessor\Tests\Models\TestModel');
        $accessor = $factory->createAccessor($schema);

        $this->assertInstanceOf('Clio\Component\Accessor\Schema\FieldContainerSchemaAccessor', $accessor);
    }
}


