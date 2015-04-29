<?php
namespace Clio\Component\Normalizer\Tests;


class NormalizerTestCase extends \PHPUnit_Framework_TestCase
{
	public function testNormalize()
	{
		$normalizer = $this->getNormalizer();

		// normalize string
		$this->assertEquals('foo', $normalizer->normalize('foo'));
		// normalize numeric
		$this->assertEquals(123, $normalizer->normalize(123));

		$this->assertEquals(array('foo', 'bar' => 'Bar'), $normalizer->normalize(array('foo', 'bar' => 'Bar')));

		$obj = new \StdClass();
		$obj->foo = 'Foo';
		$this->assertEquals(array('foo' => 'Foo'), $normalizer->normalize($obj));
	}
}
