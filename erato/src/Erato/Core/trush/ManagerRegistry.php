<?php
namespace Erato\Core;

use Erato\Core\Metadata\MetadataRegistry;
use Clio\Component\Pattern\Registry\LoadableRegistry;
use Clio\Component\Pattern\Registry\Loader\MappedFactoryLoader,
	Clio\Extra\Regsitry\Loader\CachedLoader
;

class ManagerRegistry extends LoadableRegistry 
{
	private $metadataRegistry;

	public function __construct(MetadataRegistry $metadataRegistry)
	{
		$this->metadataRegistry = $metadataRegistry;

		parent::__construct(new MappedFactoryLoader(new SchemaMetadataFactory($metadataRegistry)));
	}

    public function getMetadataRegistry()
    {
        return $this->metadataRegistry;
    }
    
    public function setMetadataRegistry($metadataRegistry)
    {
        $this->metadataRegistry = $metadataRegistry;
        return $this;
    }
}

