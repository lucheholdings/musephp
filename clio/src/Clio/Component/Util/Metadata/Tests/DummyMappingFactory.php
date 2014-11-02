<?php
namespace Clio\Component\Util\Metadata\Tests;

use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Util\Metadata\Mapping\Factory\AbstractFactory as AbstractMappingFactory;

class DummyMappingFactory extends AbstractMappingFactory 
{
	public function doCreateMapping(Metadata $metadata)
	{
		return new DummyMapping($metadata);
	}
}

