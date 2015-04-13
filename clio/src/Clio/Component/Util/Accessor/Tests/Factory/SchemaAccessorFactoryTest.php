<?php
namespace Clio\Component\Util\Accessor\Tests\Factory;

use Clio\Component\Util\Accessor\Factory\SchemaAccessorFactory;
use Clio\Component\Util\Type\Registry as TypeRegistry;
use Clio\Component\Util\Metadata\Factory\MetadataFactory;

class SchemaAccessorTest extends \PHPUnit_Framework_TestCase 
{
    public function testBasic()
    {
        $factory = new SchemaAccessorFactory();

        $schemaFactory = new MetadataFactory(TypeRegistry\Factory::createDefault());
        $schema = $schemaFactory->createMetadata('Clio\Component\Util\Accessor\Tests\Models\TestModel');
        $accessor = $factory->createAccessor($schema);

        $this->assertInstanceOf('Clio\Component\Util\Accessor\Schema\FieldContainerSchemaAccessor', $accessor);
    }
}


