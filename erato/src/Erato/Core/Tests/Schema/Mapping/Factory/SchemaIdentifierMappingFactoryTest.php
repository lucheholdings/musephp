<?php
namespace Erato\Core\Tests\Schema\Mapping\Factory;

use Erato\Core\Schema\Mapping\Factory\SchemaIdentifierMappingFactory;

class SchemaIdentifierMappingFactoryTest extends MappingFactoryTestCase
{
    public function getSchema()
    {
        return $this->getSchemaRegistry()->get('Erato\Core\Tests\Models\SimpleModel');
    }

    protected function getMappingClass()
    {
        return 'Erato\Core\Schema\Mapping\SchemaIdentifierMapping';
    }

    protected function getFactory()
    {
        return new SchemaIdentifierMappingFactory();
    }
}


