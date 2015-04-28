<?php
namespace Erato\Core\Tests;

use Erato\Core\Schema\Registry\BasicRegistry;
use Erato\Core\Schema\Config\Loader as ConfigLoaders;
use Erato\Core\Schema\Config\Parser as ConfigParsers;
use Clio\Component\Util\Type;
use Clio\Component\Util\Metadata;

class TestSchemaRegistry extends BasicRegistry
{
    public function __construct()
    {
        $typeResolver = new Type\Resolver\RegisteredResolver(Type\Registry\Factory::createDefault());

        $configLoader = new ConfigLoaders\InheritMergeLoader(
                // 1. Load from Cache if exists 
                new ConfigLoaders\ConfigurationMergeLoader(array(
                    // 1st. load default,
                    new ConfigLoaders\ClassConfigLoader(new ConfigParsers\DefaultClassConfigParser($typeResolver)),
                ))
            );

        $schemaResolver = new Metadata\Resolver\RegisteredResolver($this);

        parent::__construct($configLoader, $schemaResolver, $typeResolver);
    }
}

