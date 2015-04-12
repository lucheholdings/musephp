<?php
namespace Clio\Component\Util\Accessor\Tests\Schema;

use Clio\Component\Util\Type\BasicRegistry as TypeRegistry;
use Clio\Component\Util\Metadata\Factory\MetadataFactory;

use Clio\Component\Util\Accessor\Schema\FieldContainerSchemaAccessor;

class FieldContainerSchemaAccessorTest extends \PHPUnit_Framework_TestCase 
{
    public function testBasic()
    {
        $schemaFactory = new MetadataFactory(new TypeRegistry());
        $schema = $schemaFactory->createMetadata('Clio\Component\Util\Accessor\Tests\Models\TestModel');

        $accessor = new FieldContainerSchemaAccessor($schema);
        
    }
}


