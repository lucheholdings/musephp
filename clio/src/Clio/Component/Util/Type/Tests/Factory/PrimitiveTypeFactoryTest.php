<?php
namespace Clio\Component\Util\Type\Tests\Factory;

use Clio\Component\Util\Type\Factory\PrimitiveTypeFactory;

class PrimitiveTypeFactoryTest extends \PHPUnit_Framework_TestCase 
{
    public function testCreate()
    {
        $factory = new PrimitiveTypeFactory();
        
        $this->assertInstanceof('Clio\Component\Util\Type\Actual\ScalarType', $factory->createType('int'));
        $this->assertInstanceof('Clio\Component\Util\Type\Actual\ScalarType', $factory->createType('string'));
        $this->assertInstanceof('Clio\Component\Util\Type\Actual\ScalarType', $factory->createType('integer'));
        $this->assertInstanceof('Clio\Component\Util\Type\Actual\ScalarType', $factory->createType('char'));
        $this->assertInstanceof('Clio\Component\Util\Type\Actual\ScalarType', $factory->createType('boolean'));
        $this->assertInstanceof('Clio\Component\Util\Type\Actual\ScalarType', $factory->createType('bool'));
        $this->assertInstanceof('Clio\Component\Util\Type\Actual\ScalarType', $factory->createType('double'));
        $this->assertInstanceof('Clio\Component\Util\Type\Actual\ScalarType', $factory->createType('float'));

        $this->assertInstanceof('Clio\Component\Util\Type\Actual\ArrayType', $factory->createType('array'));
        $this->assertInstanceof('Clio\Component\Util\Type\Actual\NullType', $factory->createType('null'));
        $this->assertInstanceof('Clio\Component\Util\Type\Actual\MixedType', $factory->createType('mixed'));
    }
}

