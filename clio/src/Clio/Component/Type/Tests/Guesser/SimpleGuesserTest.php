<?php
namespace Clio\Component\Type\Tests\Guesser;

use Clio\Component\Type\Guesser\SimpleGuesser;
use Clio\Component\Type\Factory as Factories;
use Clio\Component\Type\Resolver\TypeFactoryResolver;
use Clio\Component\Type\Resolver\RegisteredResolver;
use Clio\Component\Type\PrimitiveTypes;

use Clio\Component\Type\Registry as TypeRegistry;

class SimpleGuesserTest extends \PHPUnit_Framework_TestCase 
{

    public function testCreate()
    {
        $resolver = $this->createResolver();

        $guesser = SimpleGuesser::create($resolver);

        $this->assertInstanceof('Clio\Component\Type\Guesser', $guesser);
        $this->assertInstanceof('Clio\Component\Type\Guesser\SimpleGuesser', $guesser);
    }

    public function testGuess()
    {
        $resolver = $this->createResolver();

        $guesser = SimpleGuesser::create($resolver);
        
        $type = $guesser->guess(1);
        $this->assertInstanceof('Clio\Component\Type\Actual\ScalarType', $type);
        $this->assertEquals(PrimitiveTypes::TYPE_INT, $type->getName());

        $type = $guesser->guess(1.11);
        $this->assertInstanceof('Clio\Component\Type\Actual\ScalarType', $type);
        $this->assertEquals(PrimitiveTypes::TYPE_FLOAT, $type->getName());

        $type = $guesser->guess('foo');
        $this->assertInstanceof('Clio\Component\Type\Actual\ScalarType', $type);
        $this->assertEquals(PrimitiveTypes::TYPE_STRING, $type->getName());

        $type = $guesser->guess(new \StdClass());
        $this->assertInstanceof('Clio\Component\Type\Actual\ClassType', $type);
        $this->assertEquals('stdClass', $type->getName());
    }

    public function testBasic()
    {
        $resolver = $this->createResolver();

        $guesser = new SimpleGuesser($resolver);
        

        $this->assertInstanceof('Clio\Component\Type\Resolver\TypeFactoryResolver', $guesser->getResolver());

        $newResolver = new RegisteredResolver(TypeRegistry\Factory::createDefault());
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

