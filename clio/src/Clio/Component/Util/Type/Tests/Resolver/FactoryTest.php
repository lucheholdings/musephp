<?php
namespace Clio\Component\Util\Type\Tests\Resolver;

use Clio\Component\Util\Type\Resolver\Factory;
use Clio\Component\Util\Type\Factory\PrimitiveTypeFactory;
use Clio\Component\Util\Type\Registry as TypeRegistry;

class FactoryTest extends \PHPUnit_Framework_TestCase 
{
    public function testCreateWithFactory()
    {
        $factory = new PrimitiveTypeFactory();
        $resolver = Factory::createWithFactories(array($factory));

        $this->assertInstanceof(
                'Clio\Component\Util\Type\Resolver\TypeChainResolver',
                $resolver
            );
    }
}

