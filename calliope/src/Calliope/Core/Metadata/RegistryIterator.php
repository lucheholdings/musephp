<?php
namespace Calliope\Core\Metadata;

class RegistryIterator extends \ArrayIterator 
{
	private $registry;

	public function __construct(MetadataRegistry $registry)
	{
		$this->registry = $registry;
		parent::__construct($registry->getKeyValues());
	}

	public function current()
	{
		return $this->registry->get($this->key());
	}
}

