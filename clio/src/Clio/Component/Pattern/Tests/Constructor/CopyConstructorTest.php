<?php
namespace Clio\Component\Pattern\Tests\Constructor;

use Clio\Component\Pattern\Constructor\CopyConstructor;

//class ConstructConstructorTest extends ConstructorTest
class CopyConstructorTest extends \PHPUnit_Framework_TestCase
{
    public function testBasic()
    {
        $base = new \Clio\Component\Pattern\Tests\Models\ConstructorTestModel('foo');
        $constructor = new CopyConstructor($base);

        $model = $constructor->construct();

        $this->assertEquals('foo', $model->foo);
    }
}


