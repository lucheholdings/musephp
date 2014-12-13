<?php
namespace Calliope\Core\Metadata\Factory;

//use Clio\Component\Util\Metadata\Schema\InheritedSchemaMetadata;
use Calliope\Core\Metadata\UsecaseSchema;
use Clio\Component\Util\Metadata\Mapping\Factory\Collection as MappingFactoryCollection;

use Erato\Core\Metadata\MetadataRegistry;
use Clio\Component\Util\Metadata\SchemaMetadataRegistry;

class SchemaMetadataFactory 
{
	private $registry;

	private $mappingFactory;

	public function __construct(SchemaMetadataRegistry $registry, MappingFactoryCollection $mappingFactory = null)
	{
		$this->registry = $registry;

		$this->mappingFactory = $mappingFactory;
	}

	public function createMetadata($name, $class, array $options = array())
	{
		$parentMetadata = $this->getRegistry()->get($class);

		$metadata = new UsecaseSchema($parentMetadata, $name);

		if($this->getMappingFactory()) {

			$mappingOptions = isset($options['mappings']) ? $options['mappings'] : array();
			$metadata->setMappings($this->getMappingFactory()->createMapping($metadata, $mappingOptions));
		}

		return $metadata;
	}
    
    public function getRegistry()
    {
        return $this->registry;
    }
    
    public function setRegistry($registry)
    {
        $this->registry = $registry;
        return $this;
    }
    
    public function getMappingFactory()
    {
        return $this->mappingFactory;
    }
    
    public function setMappingFactory($mappingFactory)
    {
        $this->mappingFactory = $mappingFactory;
        return $this;
    }
}

