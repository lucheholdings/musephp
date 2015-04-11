<?php
namespace Clio\Component\Pattern\Tests\Registry;

use Clio\Component\Pattern\Registry\MapRegistry;

 class MapRegistryTest extends \PHPUnit_Framework_TestCase 
{
	private $registry;

	public function testAccess()
	{
		$registry = $this->getRegistry();

		$this->assertInstanceof('Clio\Component\Pattern\Registry\Registry', $registry);

		$this->assertFalse($registry->has('foo'));

		$registry->set('foo', 'Foo');

		$this->assertTrue($registry->has('foo'));
		$this->assertEquals('Foo', $registry->get('foo'));

		$this->assertEquals(1, $registry->count());

		$registry->remove('foo');
		$this->assertFalse($registry->has('foo'));


		$registry->set('foo', 'Foo');
		$registry->set('bar', 'Bar');
		$registry->set('hoge', 'Hoge');

		$this->assertEquals(3, $registry->count());

		$registry->clear();

		$this->assertEquals(0, $registry->count());
	}

	public function getRegistry()
	{
		if(!$this->registry) {
			$this->registry = new MapRegistry();
		}

		return $this->registry;
	}
}

