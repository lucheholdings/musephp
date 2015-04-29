<?php
namespace Clio\Component\Accessor\Tests\Schema;

use Clio\Component\Type\Registry as TypeRegistry;
use Clio\Component\Metadata\Factory\SchemaFactory;

use Clio\Component\Accessor\Schema\DateTimeSchemaAccessor;

class DateTimeSchemaAccessorTest extends \PHPUnit_Framework_TestCase 
{
    public function testBasic()
    {
        $schemaFactory = new SchemaFactory(TypeRegistry\Factory::createDefault());
        $schema = $schemaFactory->createMetadata('Clio\Component\Accessor\Tests\Models\TestModel');

        $accessor = new FieldContainerSchemaAccessor($schema);
        
    }
}

