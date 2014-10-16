<?php
namespace Clio\Component\Util\Accessor\Tests;
use Clio\Component\Util\Accessor\ArrayAccessor;

class ArrayAccessorTest extends \PHPUnit_Framework_TestCase 
{
	public function testCreate()
	{
		$data = array('foo' => 'Foo', 'bar' => null, 'hoge' => false);
		$accessor = new ArrayAccessor($data);


		$this->assertFalse($accessor->isEmpty('foo'));
		// Null value is replaced 
		$this->assertTrue($accessor->isEmpty('bar'));
		// False is still a value 
		$this->assertFalse($accessor->isEmpty('hoge'));

		$this->assertContains('foo', $accessor->getFieldNames());
		$this->assertNotContains('bar', $accessor->getFieldNames());
	}
}

