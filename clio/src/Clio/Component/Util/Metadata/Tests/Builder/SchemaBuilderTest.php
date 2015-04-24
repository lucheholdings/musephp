<?php
namespace Clio\Component\Util\Metadata\Tests\Builder;

use Clio\Component\Util\Metadata;
use Clio\Component\Util\Type as Types;

use Clio\Component\Pattern\Registry;
use Clio\Component\Pattern\Loader;

class SchemaBuilderTests extends \PHPUnit_Framework_TestCase
{
    public function testBuildPrimitive()
    {
        $schemaResolver = new Metadata\Resolver\RegisteredResolver(); 
        $typeResolver = new Types\Resolver\RegisteredResolver(Types\Registry\Factory::createDefault());
        $schemaRegistry = new Metadata\Registry\ValidateRegistry(new Registry\LoadableRegistry(
                new Loader\FactoryLoader(new Metadata\Factory\SchemaFactory($schemaResolver, $typeResolver))
            ));

        $schemaResolver->setRegistry($schemaRegistry);

        $builder = new Metadata\Builder\SchemaBuilder($schemaResolver, $typeResolver);
        $builder
            ->setName('foo')
            ->setType('int')
            ->addOption('foo', 'Foo')
            ->addOption('bar', 'Bar')
            ->addField('field1', 'int')
        ;

        $metadata = $builder->getSchemaMetadata();

        $this->assertEquals('foo', $metadata->getName());
        $this->assertInstanceof('Clio\Component\Util\Type\Type', $metadata->getType());
        $this->assertEquals(Types\PrimitiveTypes::TYPE_INT, $metadata->getType()->getName());
        $this->assertCount(2, $metadata->getOptions());
        $this->assertCount(1, $metadata->getFields());
    }

    public function testBuildClass()
    {
        $schemaResolver = new Metadata\Resolver\RegisteredResolver(); 
        $typeResolver = new Types\Resolver\RegisteredResolver(Types\Registry\Factory::createDefault());
        $schemaRegistry = new Metadata\Registry\ValidateRegistry(new Registry\LoadableRegistry(
                new Loader\FactoryLoader(new Metadata\Factory\SchemaFactory($schemaResolver, $typeResolver))
            ));

        $schemaResolver->setRegistry($schemaRegistry);

        $builder = new Metadata\Builder\SchemaBuilder($schemaResolver, $typeResolver);

        $builder
            ->setName('foo')
            ->setType('Clio\Component\Util\Metadata\Tests\Models\TestModel')
            ->appendProperties()
            ->addField('field1', 'int')
        ;

        $metadata = $builder->getSchemaMetadata();

        $this->assertEquals('foo', $metadata->getName());
        $this->assertInstanceof('Clio\Component\Util\Type\Actual\ClassType', $metadata->getType());
        $this->assertEquals('Clio\Component\Util\Metadata\Tests\Models\TestModel', $metadata->getType()->getName());
        $this->assertCount(3, $metadata->getFields());
    }
}

