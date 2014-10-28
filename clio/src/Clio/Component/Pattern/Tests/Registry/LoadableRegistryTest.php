<?php
namespace Clio\Component\Pattern\Tests\Registry;

use Clio\Component\Pattern\Registry\MapRegistry;
use Clio\Component\Pattern\Registry\LoadableRegistry;
use Clio\Component\Pattern\Registry\Loader\MappedFactoryLoader;
use Clio\Component\Pattern\Factory\MappedComponentFactory;

 class LoadableRegistryTest extends \PHPUnit_Framework_TestCase 
{
	private $registry;

	public function testLoader()
	{
		$registry = $this->getRegistry();
		$this->assertCount(0, $registry->getLoaders());

		$loader = new MappedFactoryLoader(new MappedComponentFactory(array('std' => 'StdClass')));

		$loader->register($registry);
		$this->assertCount(1, $registry->getLoaders());

		$loader->unregister($registry);
		$this->assertCount(0, $registry->getLoaders());
	}

	public function getRegistry()
	{
		if(!$this->registry) {
			$this->registry = new LoadableRegistry(new MapRegistry());
		}

		return $this->registry;
	}
}

