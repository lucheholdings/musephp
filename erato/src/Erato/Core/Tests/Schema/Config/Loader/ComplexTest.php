<?php
namespace Erato\Core\Tests\Schema\Config\Loader;

use Clio\Component\Type;
use Erato\Core\Schema\Config\Loader as ConfigLoader,
    Erato\Core\Schema\Config\Parser as ConfigParser
;

class ComplexTest extends \PHPUnit_Framework_TestCase 
{
    public function testBasic()
    {
        $typeResolver = new Type\Resolver\RegisteredResolver(Type\Registry\Factory::createDefault());
        $loader = new ConfigLoader\InheritMergeLoader(new ConfigLoader\ConfigurationMergeLoader(array(
                new ConfigLoader\ClassConfigLoader(new ConfigParser\DefaultClassConfigParser($typeResolver)),
            )));

        $config = $loader->load('Erato\Core\Tests\Models\ChildClass');

        $this->assertInstanceof('Erato\Core\Schema\Config\SchemaConfiguration', $config);

        // 
        $this->assertCount(4, $config->getFields());
        $this->assertArrayHasKey('parentPrivateProperty', $config->getFields());
        $this->assertArrayHasKey('parentProtectedProperty', $config->getFields());
        $this->assertArrayHasKey('parentPublicProperty', $config->getFields());
        $this->assertArrayHasKey('childProperty', $config->getFields());
    }
}


