<?php
namespace Clio\Component\Util\Type\Tests\Guesser;

use Clio\Component\Util\Type\Guesser\SimpleGuesser;
use Clio\Component\Util\Type\Factory as Factories;
use Clio\Component\Util\Type\Resolver\TypeFactoryResolver;
use Clio\Component\Util\Type\Resolver\RegisteredTypeResolver;
use Clio\Component\Util\Type\PrimitiveTypes;
use Clio\Component\Util\Type\BasicRegistry;

class SimpleGuesserTest extends \PHPUnit_Framework_TestCase 
{

    public function testCreate()
    {
        $resolver = $this->createResolver();

        $guesser = SimpleGuesser::create($resolver);

        $this->assertInstanceof('Clio\Component\Util\Type\Guesser', $guesser);
        $this->assertInstanceof('Clio\Component\Util\Type\Guesser\SimpleGuesser', $guesser);
    }

    public function testGuess()
    {
        $resolver = $this->createResolver();

        $guesser = SimpleGuesser::create($resolver);
        
        $type = $guesser->guess(1);
        $this->assertInstanceof('Clio\Component\Util\Type\Actual\ScalarType', $type);
        $this->assertEquals(PrimitiveTypes::TYPE_INT, $type->getName());

        $type = $guesser->guess(1.11);
        $this->assertInstanceof('Clio\Component\Util\Type\Actual\ScalarType', $type);
        $this->assertEquals(PrimitiveTypes::TYPE_FLOAT, $type->getName());

        $type = $guesser->guess('foo');
        $this->assertInstanceof('Clio\Component\Util\Type\Actual\ScalarType', $type);
        $this->assertEquals(PrimitiveTypes::TYPE_STRING, $type->getName());

        $type = $guesser->guess(new \StdClass());
        $this->assertInstanceof('Clio\Component\Util\Type\Actual\ClassType', $type);
        $this->assertEquals('stdclass', $type->getName());
    }

    public function testBasic()
    {
        $resolver = $this->createResolver();

        $guesser = new SimpleGuesser($resolver);
        

        $this->assertInstanceof('Clio\Component\Util\Type\Resolver\TypeFactoryResolver', $guesser->getResolver());

        $newResolver = new RegisteredTypeResolver(new BasicRegistry());
        $guesser->setResolver($newResolver);
        $this->assertNotEquals($resolver, $guesser->getResolver());
        $this->assertEquals($newResolver, $guesser->getResolver());
    }

    protected function createResolver()
    {
        return new TypeFactoryResolver(new Factories\TypeFactoryCollection(array(
                new Factories\ClassTypeFactory(),
                new Factories\PrimitiveTypeFactory(),
            )));
    }
}

