<?php
namespace Clio\Component\Normalizer\Tests\Type;

use Clio\Component\Normalizer\Type\TypeResolver;
use Clio\Component\Type as Types;
use Clio\Component\Type\BasicRegistry;
use Clio\Component\Type\PrimitiveTypes;

class TypeResolverTest extends \PHPUnit_Framework_TestCase
{
    public function testResolve()
    {
        $resolver = TypeResolver::createWithRegistry(Types\Registry\Factory::createDefault());

        $type = $resolver->resolve('int');
        $this->assertInstanceof('Clio\Component\Normalizer\Type\NormalizerType', $type);
        $this->assertInstanceof('Clio\Component\Type\Actual\ScalarType', $type->getType());
        $this->assertEquals(PrimitiveTypes::TYPE_INT, $type->getType()->getName());


        $type = $resolver->resolve(new Types\Actual\ScalarType(PrimitiveTypes::TYPE_INT));
        $this->assertInstanceof('Clio\Component\Normalizer\Type\NormalizerType', $type);
        $this->assertInstanceof('Clio\Component\Type\Actual\ScalarType', $type->getType());
        $this->assertEquals(PrimitiveTypes::TYPE_INT, $type->getType()->getName());
    }
}

