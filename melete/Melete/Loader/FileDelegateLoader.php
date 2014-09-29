<?php
namespace Melete\Loader;

class FileDelegateLoader extends DelegateLoader 
{
	public function __construct(FileLoader $loader, $resource)
	{
		$this->loader = $loader;
		$this->resource = $resource;
	}

	public function load()
	{
		return $this->getLoader()->load($this->resource);
	}
}

