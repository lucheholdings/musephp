<?php
namespace Clio\Component\Util\Type\Tests;

use Clio\Component\Util\Type\PrimitiveTypes;


abstract class TypeTestCase extends \PHPUnit_Framework_TestCase
{
    public function testBasic()
    {
        $type = $this->createType();

        // test valid and invalid type
        foreach($this->getValidTypes() as $validType) {
            $this->assertTrue($type->isType($validType));
        }

        foreach($this->getInvalidTypes() as $invalidType) {
            $this->assertFalse($type->isType($invalidType));
        }


        // test valid and invalid data
        foreach($this->getValidDatas() as $validData) {
            $this->assertTrue($type->isValidData($validData));
        }

        foreach($this->getInvalidDatas() as $invalidData) {
            $this->assertFalse($type->isValidData($invalidData));
        }
    }

    abstract protected function createType();

    abstract protected function getValidTypes();

    abstract protected function getValidDatas();

    abstract protected function getInvalidDatas();

    protected function getInvalidTypes()
    {
        return array_diff($this->getPrimitiveTypes(), $this->getValidTypes());
    }

    public function getPrimitiveTypes()
    {
        return array(
                PrimitiveTypes::BASETYPE_SCALAR,
                PrimitiveTypes::BASETYPE_OBJECT,
                PrimitiveTypes::BASETYPE_MIXED,
                PrimitiveTypes::TYPE_INTERFACE,
                PrimitiveTypes::TYPE_NULL,
                PrimitiveTypes::TYPE_MIXED,
                PrimitiveTypes::TYPE_OBJECT,
                PrimitiveTypes::TYPE_SCALAR,
                PrimitiveTypes::TYPE_INTEGER,
                PrimitiveTypes::TYPE_DOUBLE,
                PrimitiveTypes::TYPE_FLOAT,
                PrimitiveTypes::TYPE_CHAR,
                PrimitiveTypes::TYPE_STRING,
                PrimitiveTypes::TYPE_BOOLEAN,
                PrimitiveTypes::TYPE_ARRAY,
                PrimitiveTypes::TYPE_REAL,
                PrimitiveTypes::TYPE_BINARY,
                PrimitiveTypes::TYPE_ALIAS_INT,
                PrimitiveTypes::TYPE_ALIAS_BOOL,
                PrimitiveTypes::TYPE_ALIAS_CHARACTOR,
            );
    }
}

