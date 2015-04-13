<?php
namespace Clio\Component\Pattern\Tests\Constructor;

use Clio\Component\Pattern\Constructor\ConstructConstructor;

//class ConstructConstructorTest extends ConstructorTest
class ConstructConstructorTest extends \PHPUnit_Framework_TestCase
{
    public function testBasic()
    {
        $constructor = ConstructConstructor::getInstance();
        $this->assertInstanceof('Clio\Component\Pattern\Constructor\ConstructConstructor', $constructor);
        $this->assertEquals($constructor, ConstructConstructor::getInstance(), true);

        $reflector = new \ReflectionClass('Clio\Component\Pattern\Tests\Models\ConstructorTestModel');
        $model = $constructor->construct($reflector, array('foo'));

        $this->assertEquals('foo', $model->foo);
    }
}


