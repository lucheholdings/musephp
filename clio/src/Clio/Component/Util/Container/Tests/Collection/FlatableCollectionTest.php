<?php
namespace Clio\Component\Util\Container\Tests\Collection;

use Clio\Component\Util\Container\Collection\FlatableCollection;

/**
 * FlatableCollectionTest 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FlatableCollectionTest extends \PHPUnit_Framework_TestCase
{
	public function testFlat()
	{
		$collection = new FlatableCollection(array('vars' => array('foo' => 'Foo', 'bar' => 'Bar')));

		$collection = $collection->flat();

		$this->assertCount(2, $collection);
		$this->assertTrue($collection->hasKey('vars.foo'));
		$this->assertTrue($collection->hasKey('vars.bar'));
		$this->assertEquals('Foo', $collection->get('vars.foo'));
	}

	public function testInflat()
	{
		$collection = new FlatableCollection(array('vars.foo' => 'Foo', 'vars.bar' => 'Bar'));

		$collection = $collection->inflat();

		$this->assertCount(1, $collection);
		$this->assertTrue($collection->hasKey('vars'));

		$this->assertCount(2, $collection['vars']);
		$this->assertArrayHasKey('foo', $collection->get('vars'));
		$this->assertArrayHasKey('bar', $collection->get('vars'));
	}

	public function testInflatPartial()
	{
		$collection = new FlatableCollection(array('vars.foo' => 'Vars.Foo', 'vars.bar' => 'Vars.Bar', 'etc.foo' => 'Etc.Foo', 'etc.bar' => 'Etc.Bar'));

		$collection = $collection->inflat('vars');

		// only vars inflatten, and etc.xxx is not
		$this->assertCount(2, $collection);
		$this->assertTrue($collection->hasKey('foo'));
		$this->assertTrue($collection->hasKey('bar'));

		$this->assertTrue($collection->has('Vars.Foo'));
		$this->assertTrue($collection->has('Vars.Bar'));
	}
}

