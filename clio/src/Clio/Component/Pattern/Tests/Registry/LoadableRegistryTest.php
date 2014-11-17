<?php
namespace Clio\Component\Pattern\Tests\Registry;

use Clio\Component\Pattern\Registry\RegistryMap;
use Clio\Component\Pattern\Registry\LoadableRegistry;
use Clio\Component\Pattern\Registry\Loader\MappedFactoryLoader;
use Clio\Component\Pattern\Factory\MappedComponentFactory;

 class LoadableRegistryTest extends \PHPUnit_Framework_TestCase 
{
	private $registry;

	public function testLoader()
	{
		$registry = $this->getRegistry();

		$this->assertInstanceOf('Clio\Component\Pattern\Registry\Loader\MappedFactoryLoader', $registry->getLoader());

		$entry = $this->registry->get('std');

		$this->assertInstanceOf('StdClass', $entry);
	}

	public function getRegistry()
	{
		if(!$this->registry) {
			$this->registry = new LoadableRegistry(new MappedFactoryLoader(new MappedComponentFactory(array('std' => 'StdClass'))));
		}

		return $this->registry;
	}
}

