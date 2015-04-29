<?php
namespace Erato\Core\Schema\Loader;

use Clio\Component\Pattern\Loader\Loader;
use Clio\Component\Pattern\Loader\Exception as LoaderException;
use Clio\Component\Type;
use Clio\Component\Metadata;
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
class SchemaLoader implements Metadata\Loader
{
    private $fieldFactory;

    private $schemaResolver;

    private $typeResolver;

    private $configLoader;

    private $schemaMappingFactories;

    private $fieldMappingFactories;

    /**
     * __construct 
     * 
     * @param Loader $configLoader 
     * @access public
     * @return void
     */
    public function __construct(Loader $configLoader, Metadata\Resolver $schemaResolver, Type\Resolver $typeResolver, Metadata\Mapping\NamedFactory $schemaMappingFactories = null, Metadata\Mapping\NamedFactory $fieldMappingFactories = null)
    {
        $this->configLoader = $configLoader;
        $this->schemaResolver = $schemaResolver;
        $this->typeResolver = $typeResolver;

        $this->schemaMappingFactories = $schemaMappingFactories;
        $this->fieldMappingFactories = $fieldMappingFactories;
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
        try {
            $config = $this->configLoader->load($resource);

            $builder = new SchemaBuilder($this->schemaResolver, $this->typeResolver, $this->schemaMappingFactories, $this->fieldMappingFactories);
            $builder->setConfiguration($config);

            // Build the SchemaMetadata from the configuration
            return $builder->getSchemaMetadata();
        } catch(\Exception $ex) {
            throw new LoaderException\InvalidResourceException('Failed to load resource.', 0, $ex);
        }
    }
    
    /**
     * getMappingFactories 
     * 
     * @access public
     * @return void
     */
    public function getMappingFactories()
    {
        return $this->mappingFactories;
    }
    
    /**
     * setMappingFactories 
     * 
     * @param array $mappingFactories 
     * @access public
     * @return void
     */
    public function setMappingFactories(array $mappingFactories)
    {
        $this->mappingFactories = array();
        foreach($mappingFactories as $mappingFactory) {
            $this->addMappingFactory($mappingFactory);
        }
        return $this;
    }
}

