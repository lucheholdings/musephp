<?php
namespace Erato\Adapter\SymfonyBundles\FrameworkBundle\Tests;

class MetadataRegistryTest extends TestCase 
{
	public function testHello()
	{
		$kernel = $this->getKernel();
		$kernel->getContainer();


		$registry = $this->get('erato_framework.metadata.registry');
	}
}

