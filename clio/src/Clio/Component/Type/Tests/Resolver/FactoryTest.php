<?php
namespace Clio\Component\Type\Tests\Resolver;

use Clio\Component\Type\Resolver\Factory;
use Clio\Component\Type\Factory\PrimitiveTypeFactory;
use Clio\Component\Type\Registry as TypeRegistry;

class FactoryTest extends \PHPUnit_Framework_TestCase 
{
    public function testCreateWithFactory()
    {
        $factory = new PrimitiveTypeFactory();
        $resolver = Factory::createWithFactories(array($factory));

        $this->assertInstanceof(
                'Clio\Component\Type\Resolver\TypeChainResolver',
                $resolver
            );
    }
}

