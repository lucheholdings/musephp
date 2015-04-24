<?php
namespace Clio\Component\Util\Accessor\Tests\Factory;

use Clio\Component\Util\Accessor\Factory\SchemaAccessorFactory;
use Clio\Component\Util\Type;
use Clio\Component\Util\Metadata;

class SchemaAccessorTest extends \PHPUnit_Framework_TestCase 
{
    public function testBasic()
    {
        $factory = new SchemaAccessorFactory();

        $schemaFactory = new Metadata\Factory\SchemaFactory(
                new Metadata\Resolver\LazyResolver(new Metadata\Resolver\NullResolver()), 
                new Type\Resolver\RegisteredResolver(Type\Registry\Factory::createDefault())
            );
        $schema = $schemaFactory->createSchemaMetadata('Clio\Component\Util\Accessor\Tests\Models\TestModel');
        $accessor = $factory->createAccessor($schema);

        $this->assertInstanceOf('Clio\Component\Util\Accessor\Schema\FieldContainerSchemaAccessor', $accessor);
    }
}


