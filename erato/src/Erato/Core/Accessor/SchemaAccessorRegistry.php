<?php
namespace Erato\Core\Accessor;

class SchemaAccessorRegistry extends BaseRegistry
{
	public function __construct(MetadataRegistry $regsitry)
	{
		$this->metadataRegistry = $metadataRegistry;
	}

	public function get($name)
	{
		$metadata = $this->getMetadataRegistry()->get($name);

		return $metadata->getMapping('accessor')->getAccessor();
	}

	public function has($name)
	{
		if(!$this->getMetadataRegistry()->has($name))
			return false;

		$metadata = $this->getMetadataRegistry()->get($name);
		return $metadata->hasMapping('accessor');
	}

	public function set()
	{
		throw new Exception('SchemaAccessorRegistry does not support set method. It only accept has/get method with MetadataRegistry');
	}
}

