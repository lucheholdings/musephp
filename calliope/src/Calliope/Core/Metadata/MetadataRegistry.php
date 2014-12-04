<?php
namespace Calliope\Core\Metadata;

use Calliope\Core\SchemaRegistry;
use Clio\Component\Pattern\Registry\RegistryMap;
use Calliope\Core\Metadata\Factory\SchemaMetadataFactory;

class MetadataRegistry extends RegistryMap implements SchemaRegistry
{
	private $metadataFactory;

	public function __construct(SchemaMetadataFactory $metadataFactory)
	{
		parent::__construct();

		$this->metadataFactory = $metadataFactory;
	}

	protected function initRegistry()
	{
		//$this->setValueValidator(new ClassValidator('Clio\Component\Util\Metadata\SchemaMetadata'));
	}

	public function get($name)
	{
		$metadata = parent::get($name);

		if(is_array($metadata)) {
			// create metadata object from the configuration.
			$metadata = $this->getMetadataFactory()->createMetadata($name, $metadata['class'], $metadata);

			$this->set($name, $metadata);
		}

		return $metadata;
	}
    
    public function getMetadataFactory()
    {
        return $this->metadataFactory;
    }
    
    public function setMetadataFactory($metadataFactory)
    {
        $this->metadataFactory = $metadataFactory;
        return $this;
    }

	public function getIterator()
	{
		return new RegistryIterator($this);
	}

	public function getSchema($name)
	{
		return $this->get($name);
	}
}

