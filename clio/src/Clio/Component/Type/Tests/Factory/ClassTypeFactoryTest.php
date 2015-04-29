<?php
namespace Clio\Component\Type\Tests\Factory;

use Clio\Component\Type\Factory\ClassTypeFactory;

class ClassTypeFactoryTest extends \PHPUnit_Framework_TestCase 
{
    public function testCreate()
    {
        $factory = new ClassTypeFactory();
        
        $this->assertInstanceof('Clio\Component\Type\Actual\ClassType', $factory->createType('Clio\Component\Type\Tests\Models\Foo'));
        $this->assertInstanceof('Clio\Component\Type\Actual\InterfaceType', $factory->createType('Clio\Component\Type\Tests\Models\FooInterface'));
    }
}

