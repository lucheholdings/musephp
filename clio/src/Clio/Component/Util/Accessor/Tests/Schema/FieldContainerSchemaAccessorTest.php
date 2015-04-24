<?php
namespace Clio\Component\Util\Accessor\Tests\Schema;

use Clio\Component\Util\Type;
use Clio\Component\Util\Metadata;

use Clio\Component\Util\Accessor\Schema\FieldContainerSchemaAccessor;

class FieldContainerSchemaAccessorTest extends \PHPUnit_Framework_TestCase 
{
    public function testBasic()
    {
        $schemaFactory = new Metadata\Factory\SchemaFactory(
                new Metadata\Resolver\LazyResolver(new Metadata\Resolver\NullResolver()), 
                new Type\Resolver\RegisteredResolver(Type\Registry\Factory::createDefault())
            );
        $schema = $schemaFactory->createSchemaMetadata('Clio\Component\Util\Accessor\Tests\Models\TestModel');

        $accessor = new FieldContainerSchemaAccessor($schema);
        
    }
}


