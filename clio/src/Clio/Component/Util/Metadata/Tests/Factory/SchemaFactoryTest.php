<?php
namespace Clio\Component\Util\Metadata\Tests\Factory;

use Clio\Component\Util\Metadata;
use Clio\Component\Util\Metadata\Factory\SchemaFactory;
use Clio\Component\Util\Type as Types;

class SchemaFactoryTest extends \PHPUnit_Framework_TestCase 
{
    public function testCreateBuilder()
    {
        $typeRegistry = Types\Registry\Factory::createDefault();
        $factory = new SchemaFactory(new Metadata\Resolver\RegisteredResolver(), new Types\Resolver\RegisteredResolver($typeRegistry));
        
        $builder = $factory->createBuilder();

        $this->assertInstanceof('Clio\Component\Util\Metadata\Builder\SchemaBuilder', $builder);
    }
}

