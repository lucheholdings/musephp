<?php
namespace Erato\Core\Schema\Registry;

use Erato\Core\Schema\Registry as SchemaRegistry;
use Erato\Core\Schema\Loader\SchemaLoader;
use Erato\Core\Schema\Config\Loader as ConfigLoaders;
use Erato\Core\Schema\Config\Parser as ConfigParsers;
use Clio\Component\Pattern\Loader;
use Clio\Component\Pattern\Registry;
use Clio\Extra\Loader as ExtraLoader;
use Clio\Component\Util\Metadata;
use Clio\Component\Util\Type;

/**
 * ValidateRegistry 
 * 
 * @uses ProxyRegistry
 * @uses Registry
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class BasicRegistry extends Metadata\Registry\ValidateRegistry implements SchemaRegistry 
{
    /**
     * createDefault 
     * 
     * @param mixed $typeRegistry 
     * @static
     * @access public
     * @return void
     */
    static public function createDefault(Metadata\Resolver $schemaResolver, Type\Resolver $typeResolver)
    {
        $configLoader = new ExtraLoader\CacheLoader(
                new ConfigLoaders\InheritMergeLoader(
                    // 1. Load from Cache if exists 
                    new ConfigLoaders\ConfigurationMergeLoader(array(
                        // 1st. load default,
                        new ConfigLoaders\ClassConfigLoader(new ConfigParsers\DefaultClassConfigParser($typeResolver)),
                        // 2nd load from mapped file
                        new ExtraLoader\FormattedFileLoader(new Loader\FileLocator(), array('json', 'yaml'), new ConfigParsers\ArrayParser()),
                        // 3rd. Load from Annotation
                    ))
                )
            ); 

        return new self($configLoader, $schemaResolver, $typeResolver);
    }
    /**
     * __construct 
     * 
     * @param Loader\Loader $loader 
     * @access public
     * @return void
     */
    public function __construct($configLoader, Metadata\Resolver $schemaResolver, Type\Resolver $typeResolver, array $mappingFactories = array())
    {
        // Load Configuration and build 
        parent::__construct(new Registry\LoadableRegistry(new SchemaLoader(
                $configLoader,
                $schemaResolver,
                $typeResolver,
                $mappingFactories
            )));
    }
}

