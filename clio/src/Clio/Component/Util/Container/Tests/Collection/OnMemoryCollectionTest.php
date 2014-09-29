<?php
namespace Clio\Component\Util\Container\Tests\Collection;

use Clio\Component\Util\Container\Collection\Collection;

/**
 * Test 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class CollectionTest extends \PHPUnit_Framework_TestCase
{
	public function testConstruct()
	{
		$collection = new Collection(array('foo' => 'Foo', 'bar' => 'Bar'));

		$this->assertInstanceOf('Clio\Component\Util\Container\\Collection\\Collection', $collection);
		$this->assertCount(2, $collection);
		$this->assertContains('Foo', $collection);
		$this->assertContains('Bar', $collection);
	}

	public function testGetSet()
	{
		$collection = $this->create();

		$collection->set('foo', 'hoge');

		$this->assertContains('hoge', $collection);
		$this->assertEquals('hoge', $collection['foo']);

		// Overwrite foo
		$collection->set('foo', 'bar');
		$this->assertEquals('bar', $collection['foo']);
	}

	public function testHas()
	{
		$collection = $this->create();

		$this->assertTrue(isset($collection['foo']));
		$this->assertTrue($collection->hasKey('foo'));
	}

	public function testRemove()
	{
		$collection = $this->create();

		$this->assertTrue(isset($collection['foo']));

		unset($collection['foo']);
		$this->assertFalse(isset($collection['foo']));
	}

	private function create()
	{
		return new Collection(array(
			'foo' => 'Foo',
			'bar' => 'Bar',
		));
	}
}

