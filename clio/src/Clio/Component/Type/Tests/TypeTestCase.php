<?php
namespace Clio\Component\Type\Tests;

use Clio\Component\Type\PrimitiveTypes;

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
            $this->assertFalse($type->isType($invalidType), sprintf('Failed asserting that true is false with type "%s"', $invalidType));
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
                PrimitiveTypes::BASE_TYPE_SCALAR,
                PrimitiveTypes::TYPE_NULL,
                PrimitiveTypes::TYPE_MIXED,
                PrimitiveTypes::TYPE_CLASS,
                PrimitiveTypes::TYPE_INTERFACE,

                PrimitiveTypes::TYPE_INT,
                PrimitiveTypes::TYPE_FLOAT,
                PrimitiveTypes::TYPE_STRING,
                PrimitiveTypes::TYPE_BOOL,
                PrimitiveTypes::TYPE_ARRAY,

                PrimitiveTypes::TYPE_ALIAS_CHAR,
                PrimitiveTypes::TYPE_ALIAS_CHARACTOR,
                PrimitiveTypes::TYPE_ALIAS_INTEGER,
                PrimitiveTypes::TYPE_ALIAS_BOOLEAN,
                PrimitiveTypes::TYPE_ALIAS_OBJECT,
                PrimitiveTypes::TYPE_ALIAS_DOUBLE,
                PrimitiveTypes::TYPE_ALIAS_REAL,
            );
    }
}

