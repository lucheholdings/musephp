<?php
namespace Clio\Component\Pattern\Tests\Constructor;

use Clio\Component\Pattern\Constructor\StaticMethodConstructor;

//class StaticMethodConstructorTest extends ConstructorTest
class StaticMethodConstructorTest extends \PHPUnit_Framework_TestCase
{
    public function testBasic()
    {
        $constructor = new StaticMethodConstructor('factory');

        $reflector = new \ReflectionClass('Clio\Component\Pattern\Tests\Models\ConstructorTestModel');
        $model = $constructor->construct($reflector, array('foo'));

        $this->assertInstanceof('Clio\Component\Pattern\Tests\Models\ConstructorTestModel', $model);
        $this->assertEquals('foo', $model->foo);

        $constructor->setMethod('create');
        $this->assertEquals('create', $constructor->getMethod());
        $constructor->setMethod('factory');
    }
}


