<?php
namespace Clio\Component\Pattern\Tests\Constructor;

use Clio\Component\Pattern\Constructor\NoConstructConstructor;

//class NoConstructConstructorTest extends ConstructorTest
class NoConstructConstructorTest extends \PHPUnit_Framework_TestCase
{
    public function testBasic()
    {
        $constructor = NoConstructConstructor::getInstance();
        $this->assertInstanceof('Clio\Component\Pattern\Constructor\NoConstructConstructor', $constructor);
        $this->assertEquals($constructor, NoConstructConstructor::getInstance(), true);

        $reflector = new \ReflectionClass('Clio\Component\Pattern\Tests\Models\ConstructorTestModel');
        $model = $constructor->construct($reflector, array('foo'));

        $this->assertNull($model->foo);
    }
}


