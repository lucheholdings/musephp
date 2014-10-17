<?php
namespace Clio\Component\Util\Accessor\Tests;
use Clio\Component\Util\Accessor\ArrayAccessor;

class ArrayAccessorTest extends AbstractAccessorTest
{
	const ACCESSOR_CLASS = 'Clio\Component\Util\Accessor\ArrayAccessor';

	protected function getDefaultData()
	{
		return array('foo' => 'Foo', 'bar' => null, 'hoge' => false);
	}

	protected function createAccessor($data = null)
	{
		if(!$data) {
			$data = $this->getDefaultData();
		}

		$class = self::ACCESSOR_CLASS;
		return new $class($data);
	}
}

