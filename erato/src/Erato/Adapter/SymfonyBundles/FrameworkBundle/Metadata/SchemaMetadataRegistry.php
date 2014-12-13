<?php
namespace Erato\Adapter\SymfonyBundles\FrameworkBundle\Metadata;

use Clio\Adapter\SymfonyBundles\ComponentBundle\DependencyInjection\ServiceReference;

use Erato\Core\SchemaRegistry as RegistryInterface;


class SchemaMetadataRegistry extends ServiceReference implements RegistryInterface 
{
	public function getSchemaMetadata($schemaName)
	{
		return $this->get($schemaName);
	}
}
 
