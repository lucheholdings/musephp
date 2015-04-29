<?php
namespace Clio\Component\Metadata\Tests;

use Clio\Component\Metadata\Metadata;
use Clio\Component\Metadata\Mapping\Factory\AbstractFactory as AbstractMappingFactory;

class DummyMappingFactory extends AbstractMappingFactory 
{
	public function doCreateMapping(Metadata $metadata)
	{
		return new DummyMapping($metadata);
	}
}

