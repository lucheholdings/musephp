<?php
namespace Clio\Component\Tool\Normalizer\Tests\Type;

use Clio\Component\Tool\Normalizer\Type\TypeResolver;
use Clio\Component\Util\Type as Types;
use Clio\Component\Util\Type\Resolver\Factory as ActualResolverFactory;
use Clio\Component\Util\Type\BasicRegistry;
use Clio\Component\Util\Type\PrimitiveTypes;

class TypeResolverTest extends \PHPUnit_Framework_TestCase
{
    public function testResolve()
    {
        $resolver = new TypeResolver(ActualResolverFactory::createWithRegistry(new BasicRegistry()));

        $type = $resolver->resolve('int');
        $this->assertInstanceof('Clio\Component\Tool\Normalizer\Type\NormalizerType', $type);
        $this->assertInstanceof('Clio\Component\Util\Type\Actual\ScalarType', $type->getType());
        $this->assertEquals(PrimitiveTypes::TYPE_INT, $type->getType()->getName());


        $type = $resolver->resolve(new Types\Actual\ScalarType(PrimitiveTypes::TYPE_INT));
        $this->assertInstanceof('Clio\Component\Tool\Normalizer\Type\NormalizerType', $type);
        $this->assertInstanceof('Clio\Component\Util\Type\Actual\ScalarType', $type->getType());
        $this->assertEquals(PrimitiveTypes::TYPE_INT, $type->getType()->getName());
    }
}

