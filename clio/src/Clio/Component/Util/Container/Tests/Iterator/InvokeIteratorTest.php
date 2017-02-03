<?php
namespace Clio\Component\Util\Container\Tests\Iterator;

use Clio\Component\Util\Container\Iterator\InvokeIterator;

class InvokeIteratorTest extends \PHPUnit_Framework_TestCase
{
	public function testInvokeClosure()
	{
		$data = array(
			'foo' => new Str('foo'),
			'bar' => new Str('bar'),
		);
		$iterator = new InvokeIterator(new \ArrayIterator($data), function($data){ return $data->getUpperCase(); });

		foreach($iterator as $key => $value) {
			$this->assertEquals(strtoupper($key), $value);
		}
	}
}

