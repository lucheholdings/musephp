<?php
namespace Clio\Component\Util\Metadata\Tests\Factory;

use Clio\Component\Util\Metadata\Factory\MetadataFactory;
use Clio\Component\Util\Type as Types;

class MetadataFactoryTest extends \PHPUnit_Framework_TestCase 
{
    public function testCreateBuilder()
    {
        $typeRegistry = Types\Registry\Factory::createDefault();
        $factory = new MetadataFactory($typeRegistry);
        
        $builder = $factory->createBuilder();

        $this->assertInstanceof('Clio\Component\Util\Metadata\Builder\SchemaBuilder', $builder);
    }
}

