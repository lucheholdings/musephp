<?php
namespace Clio\Component\Type\Tests\Factory;

use Clio\Component\Type\Factory\PrimitiveTypeFactory;

class PrimitiveTypeFactoryTest extends \PHPUnit_Framework_TestCase 
{
    public function testCreate()
    {
        $factory = new PrimitiveTypeFactory();
        
        $this->assertInstanceof('Clio\Component\Type\Actual\ScalarType', $factory->createType('int'));
        $this->assertInstanceof('Clio\Component\Type\Actual\ScalarType', $factory->createType('string'));
        $this->assertInstanceof('Clio\Component\Type\Actual\ScalarType', $factory->createType('integer'));
        $this->assertInstanceof('Clio\Component\Type\Actual\ScalarType', $factory->createType('char'));
        $this->assertInstanceof('Clio\Component\Type\Actual\ScalarType', $factory->createType('boolean'));
        $this->assertInstanceof('Clio\Component\Type\Actual\ScalarType', $factory->createType('bool'));
        $this->assertInstanceof('Clio\Component\Type\Actual\ScalarType', $factory->createType('double'));
        $this->assertInstanceof('Clio\Component\Type\Actual\ScalarType', $factory->createType('float'));

        $this->assertInstanceof('Clio\Component\Type\Actual\ArrayType', $factory->createType('array'));
        $this->assertInstanceof('Clio\Component\Type\Actual\NullType', $factory->createType('null'));
        $this->assertInstanceof('Clio\Component\Type\MixedType', $factory->createType('mixed'));
    }
}

