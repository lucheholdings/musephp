<?php
namespace Clio\Component\Util\Accessor\Tests\Schema;

use Clio\Component\Util\Type\Registry as TypeRegistry;
use Clio\Component\Util\Metadata\Factory\SchemaFactory;

use Clio\Component\Util\Accessor\Schema\DateTimeSchemaAccessor;

class DateTimeSchemaAccessorTest extends \PHPUnit_Framework_TestCase 
{
    public function testBasic()
    {
        $schemaFactory = new SchemaFactory(TypeRegistry\Factory::createDefault());
        $schema = $schemaFactory->createMetadata('Clio\Component\Util\Accessor\Tests\Models\TestModel');

        $accessor = new FieldContainerSchemaAccessor($schema);
        
    }
}

