<?php
namespace Clio\Component\Util\Type\Tests;

use Clio\Component\Util\Type\ClassType;
use Clio\Component\Util\Type\PrimitiveTypes;

/**
 * ClassTypeTest 
 * 
 * @uses TypeTestCase
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ClassTypeTest extends TypeTestCase 
{
    /**
     * testConstruct 
     * 
     * @access public
     * @return void
     */
    public function testConstruct()
    {
        $type = new ClassType('Clio\Component\Util\Type\Tests\Models\Foo');
        
        $this->assertInstanceof('Clio\Component\Util\Type\ClassType', $type);


        try {
            $type = new ClassType('int');

            $this->fail('Expected ReflectionException is thrown.');
        } catch(\ReflectionException $ex) {
            $this->assertTrue(true);
        }

        try {
            $type = new ClassType('Serializable');

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
        $this->assertTrue($type->isInstanceof('Clio\Component\Util\Type\Tests\Models\Foo'));
        $this->assertTrue($type->isInstanceof('\Clio\Component\Util\Type\Tests\Models\Foo'));
        $this->assertFalse($type->isInstanceof('Clio\Component\Util\Type\Tests\Models\FooInterface'));
        $this->assertFalse($type->isInstanceof('Clio\Component\Util\Type\Tests\Models\BaseModel'));
        $this->assertFalse($type->isInstanceof('Serializable'));

        // isImplements only accept interface
        $this->assertTrue($type->isImplements('Clio\Component\Util\Type\Tests\Models\FooInterface'));
        $this->assertFalse($type->isImplements('Serializable'));
        // class 
        $this->assertFalse($type->isImplements('Clio\Component\Util\Type\Tests\Models\Foo'));


        // isExtends accept both class and interface, but not the actual 
        $this->assertFalse($type->isExtends('Clio\Component\Util\Type\Tests\Models\Foo'));
        $this->assertTrue($type->isExtends('Clio\Component\Util\Type\Tests\Models\FooInterface'));
        $this->assertTrue($type->isExtends('Clio\Component\Util\Type\Tests\Models\BaseModel'));

        // 
        $this->assertFalse($type->isImplements('Serializable'));
        $this->assertFalse($type->isImplements('Clio\Component\Util\Type\Tests\Models\Bar'));
    }

    protected function createType()
    {
        return new ClassType('Clio\Component\Util\Type\Tests\Models\Foo');
    }

    protected function getValidTypes()
    {
        return array(
                PrimitiveTypes::TYPE_OBJECT, 
                'Clio\Component\Util\Type\Tests\Models\Foo',
                'Clio\Component\Util\Type\Tests\Models\FooInterface',
                'Clio\Component\Util\Type\Tests\Models\BaseModel',
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
        return array(
                'abcdefg',
                123,
                true,
                array(),
                new Models\Bar(),
            );
    }
}

