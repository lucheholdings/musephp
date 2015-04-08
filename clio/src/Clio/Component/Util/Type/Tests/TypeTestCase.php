<?php
namespace Clio\Component\Util\Type\Tests;

use Clio\Component\Util\Type\Actual\PrimitiveTypes;

/**
 * TypeTestCase 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class TypeTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * testBasic 
     * 
     * @access public
     * @return void
     */
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

    /**
     * createType 
     * 
     * @abstract
     * @access protected
     * @return void
     */
    abstract protected function createType();

    /**
     * getValidTypes 
     * 
     * @abstract
     * @access protected
     * @return void
     */
    abstract protected function getValidTypes();

    /**
     * getValidDatas 
     * 
     * @abstract
     * @access protected
     * @return void
     */
    abstract protected function getValidDatas();

    /**
     * getInvalidDatas 
     * 
     * @abstract
     * @access protected
     * @return void
     */
    abstract protected function getInvalidDatas();

    /**
     * getInvalidTypes 
     * 
     * @access protected
     * @return void
     */
    protected function getInvalidTypes()
    {
        return array_diff($this->getPrimitiveTypes(), $this->getValidTypes());
    }

    /**
     * getPrimitiveTypes 
     * 
     * @access public
     * @return void
     */
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

