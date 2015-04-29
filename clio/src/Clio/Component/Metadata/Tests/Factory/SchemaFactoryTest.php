<?php
namespace Clio\Component\Metadata\Tests\Factory;

use Clio\Component\Metadata;
use Clio\Component\Metadata\Factory\SchemaFactory;
use Clio\Component\Type as Types;

class SchemaFactoryTest extends \PHPUnit_Framework_TestCase 
{
    public function testCreateBuilder()
    {
        $typeRegistry = Types\Registry\Factory::createDefault();
        $factory = new SchemaFactory(new Metadata\Resolver\RegisteredResolver(), new Types\Resolver\RegisteredResolver($typeRegistry));
        
        $builder = $factory->createBuilder();

        $this->assertInstanceof('Clio\Component\Metadata\Builder\SchemaBuilder', $builder);
    }
}

