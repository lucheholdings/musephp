<?php
namespace Clio\Extra\Tests\Type;

use Clio\Component\Util\Type\Tests\TypeTestCase;
use Clio\Extra\Type\SchemaMetadataType;

use Clio\Component\Util\Metadata\Schema\SchemaMetadata;
use Clio\Component\Util\Type as Types;
use Clio\Component\Util\Type\Tests\Models;

class SchemaMetadataTypeTest extends TypeTestCase
{
    protected function createType()
    {
        return new SchemaMetadataType(new SchemaMetadata(new Types\Actual\ClassType('Clio\Component\Util\Type\Tests\Models\Foo'))); 
    }

    protected function getValidTypes()
    {
        return  array(
                Types\PrimitiveTypes::TYPE_CLASS,
                Types\PrimitiveTypes::TYPE_ALIAS_OBJECT,
                'Clio\Component\Util\Type\Tests\Models\Foo',
            );
    }

    protected function getValidDatas()
    {
        return array(
                new Models\Foo(),
            );
    }

    protected function getInvalidDatas()
    {
        return array(1, 'foo');
    }
}

