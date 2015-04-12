<?php
namespace Clio\Component\Util\Metadata\Tests\Builder;

use Clio\Component\Util\Metadata\Builder\SchemaBuilder;
use Clio\Component\Util\Metadata\Factory\MetadataFactory;
use Clio\Component\Util\Metadata\Factory\FieldMetadataFactory;
use Clio\Component\Util\Type as Types;

use Clio\Component\Pattern\Registry\FactoryRegistry;

class SchemaBuilderTests extends \PHPUnit_Framework_TestCase
{
    public function testBuildPrimitive()
    {
        $typeRegistry = new Types\BasicRegistry();
        $factory = new MetadataFactory($typeRegistry);
        $builder = new SchemaBuilder($factory, $typeRegistry);

        $schemaRegistry = new FactoryRegistry($factory);
        $fieldFactory = new FieldMetadataFactory($schemaRegistry);

        $factory->setFieldFactory($fieldFactory);

        $builder
            ->setName('foo')
            ->setType('int')
            ->setTypeRegistry($typeRegistry)
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
        $typeRegistry = new Types\BasicRegistry();
        $factory = new MetadataFactory($typeRegistry);
        $builder = new SchemaBuilder($factory, $typeRegistry);

        $schemaRegistry = new FactoryRegistry($factory);
        $fieldFactory = new FieldMetadataFactory($schemaRegistry);

        $factory->setFieldFactory($fieldFactory);

        $builder
            ->setName('foo')
            ->setType('Clio\Component\Util\Metadata\Tests\Models\TestModel')
            ->setTypeRegistry($typeRegistry)
            ->addField('field1', 'int')
        ;

        $metadata = $builder->getSchemaMetadata();

        $this->assertEquals('foo', $metadata->getName());
        $this->assertInstanceof('Clio\Component\Util\Type\Actual\ClassType', $metadata->getType());
        $this->assertEquals('Clio\Component\Util\Metadata\Tests\Models\TestModel', $metadata->getType()->getName());
        $this->assertCount(3, $metadata->getFields());
    }
}

