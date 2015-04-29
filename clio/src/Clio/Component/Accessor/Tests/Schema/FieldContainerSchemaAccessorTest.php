<?php
namespace Clio\Component\Accessor\Tests\Schema;

use Clio\Component\Type;
use Clio\Component\Metadata;

use Clio\Component\Accessor\Schema\FieldContainerSchemaAccessor;

class FieldContainerSchemaAccessorTest extends \PHPUnit_Framework_TestCase 
{
    public function testBasic()
    {
        $schemaFactory = new Metadata\Factory\SchemaFactory(
                new Metadata\Resolver\LazyResolver(new Metadata\Resolver\NullResolver()), 
                new Type\Resolver\RegisteredResolver(Type\Registry\Factory::createDefault())
            );
        $schema = $schemaFactory->createSchemaMetadata('Clio\Component\Accessor\Tests\Models\TestModel');

        $accessor = new FieldContainerSchemaAccessor($schema);
        
    }
}


