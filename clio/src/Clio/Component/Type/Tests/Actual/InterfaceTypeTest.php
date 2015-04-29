<?php
namespace Clio\Component\Type\Tests;

use Clio\Component\Type\Tests\TypeTestCase;
use Clio\Component\Type\Actual\InterfaceType;
use Clio\Component\Type\PrimitiveTypes;

use Clio\Component\Type\Tests\Models;
/**
 * InterfaceTypeTest 
 * 
 * @uses \Clio\Component\Type\Tests\TypeTestCase
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class InterfaceTypeTest extends TypeTestCase 
{
    /**
     * testConstruct 
     * 
     * @access public
     * @return void
     */
    public function testConstruct()
    {
        $type = new InterfaceType('Clio\Component\Type\Tests\Models\FooInterface');
        
        $this->assertInstanceof('Clio\Component\Type\Actual\InterfaceType', $type);


        try {
            $type = new InterfaceType('int');

            $this->fail('Expected ReflectionException is thrown.');
        } catch(\InvalidArgumentException $ex) {
            $this->assertTrue(true);
        }

        try {
            $type = new InterfaceType('Foo');

            $this->fail('Expected InvalidArgumentException is thrown.');
        } catch(\InvalidArgumentException $ex) {
            $this->assertTrue(true);
        }
    }

    /**
     * testExtends 
     * 
     * @access public
     * @return void
     */
    public function testExtends()
    {
        $type = $this->createType();

        // isInstanceOf only accept the actual class
        $this->assertTrue($type->isName('Clio\Component\Type\Tests\Models\FooInterface'));
        $this->assertTrue($type->isName('\Clio\Component\Type\Tests\Models\FooInterface'));
        $this->assertFalse($type->isName('Countable'));

        // isImplements only accept interface
        $this->assertTrue($type->isImplements('Countable'));
        $this->assertFalse($type->isImplements('Serializable'));
        // class 
        $this->assertFalse($type->isImplements('Clio\Component\Type\Tests\Models\Foo'));


        // isExtends 
        $this->assertFalse($type->isExtends('Countable'));
        $this->assertFalse($type->isExtends('Serializable'));
        // class 
        $this->assertFalse($type->isExtends('Clio\Component\Type\Tests\Models\Foo'));
    }

    /**
     * createType 
     * 
     * @access protected
     * @return void
     */
    protected function createType()
    {
        return new InterfaceType('Clio\Component\Type\Tests\Models\FooInterface');
    }

    /**
     * getValidTypes 
     * 
     * @access protected
     * @return void
     */
    protected function getValidTypes()
    {
        return array(
                PrimitiveTypes::TYPE_INTERFACE, 
                'Clio\Component\Type\Tests\Models\FooInterface',
                'Countable'
            );
    }

    /**
     * getValidDatas 
     * 
     * @access protected
     * @return void
     */
    protected function getValidDatas()
    {
        return array(
                new Models\Foo(),
            );
    }

    /**
     * getInvalidDatas 
     * 
     * @access protected
     * @return void
     */
    protected function getInvalidDatas()
    {
        return array(
                'abcdefg',
                123,
                true,
                array(),
                new Models\Bar(),
            );
    }
}

