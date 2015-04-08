<?php
namespace Clio\Component\Util\Type\Tests\Factory;

use Clio\Component\Util\Type\Factory\ClassTypeFactory;

class ClassTypeFactoryTest extends \PHPUnit_Framework_TestCase 
{
    public function testCreate()
    {
        $factory = new ClassTypeFactory();
        
        $this->assertInstanceof('Clio\Component\Util\Type\Actual\ClassType', $factory->createType('Clio\Component\Util\Type\Tests\Models\Foo'));
        $this->assertInstanceof('Clio\Component\Util\Type\Actual\InterfaceType', $factory->createType('Clio\Component\Util\Type\Tests\Models\FooInterface'));
    }
}

