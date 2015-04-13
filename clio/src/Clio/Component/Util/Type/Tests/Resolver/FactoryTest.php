<?php
namespace Clio\Component\Util\Type\Tests\Resolver;

use Clio\Component\Util\Type\Resolver\Factory;
use Clio\Component\Util\Type\Factory\PrimitiveTypeFactory;
use Clio\Component\Util\Type\Registry as TypeRegistry;

class FactoryTest extends \PHPUnit_Framework_TestCase 
{
    public function testCreateWithRegistry()
    {
        $registry = TypeRegistry\Factory::createDefault();
        $resolver = Factory::createWithRegistry($registry);

        $this->assertInstanceof(
                'Clio\Component\Util\Type\Resolver\TypeChainResolver',
                $resolver
            );
    }

    public function testCreateWithFactory()
    {
        $factory = new PrimitiveTypeFactory();
        $resolver = Factory::createWithFactory($factory);

        $this->assertInstanceof(
                'Clio\Component\Util\Type\Resolver\TypeChainResolver',
                $resolver
            );
    }
}

