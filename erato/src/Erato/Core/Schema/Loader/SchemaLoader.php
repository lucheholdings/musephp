<?php
namespace Erato\Core\Schema\Loader;

use Clio\Component\Pattern\Loader\Loader;
use Clio\Component\Util\Type;
use Clio\Component\Util\Metadata\Schema;
use Erato\Core\Schema\Builder\SchemaBuilder;

/**
 * SchemaLoader 
 * 
 * @uses Loader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemaLoader implements Loader
{
    private $fieldFactory;

    private $schemaResolver;

    private $typeResolver;

    private $configLoader;

    private $mappingFactories;

    /**
     * __construct 
     * 
     * @param Loader $configLoader 
     * @access public
     * @return void
     */
    public function __construct(Loader $configLoader, Schema\Resolver $schemaResolver, Type\Resolver $typeResolver, array $mappingFactories= array())
    {
        $this->configLoader = $configLoader;
        $this->schemaResolver = $schemaResolver;
        $this->typeResolver = $typeResolver;
        $this->mappingFactories = $mappingFactories;
    }

    /**
     * load 
     * 
     * @param mixed $resource 
     * @access public
     * @return void
     */
    public function load($resource)
    {
        $config = $this->configLoader->load($resource);

        $builder = new SchemaBuilder($this->schemaResolver, $this->typeResolver, $this->mappingFactories);
        $builder->setConfiguration($config);

        // Build the SchemaMetadata from the configuration
        return $builder->getSchemaMetadata();
    }
}

