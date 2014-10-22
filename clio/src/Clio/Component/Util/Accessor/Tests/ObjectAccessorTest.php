<?php
namespace Clio\Component\Util\Accessor\Tests;

use Clio\Component\Util\Accessor\Tests\Models;
use Clio\Component\Util\Accessor\SimpleSchemaAccessor;
use Clio\Component\Util\Accessor\Field\PublicPropertyFieldAccessor,
	Clio\Component\Util\Accessor\Field\MethodFieldAccessor
;

class ObjectAccessorTest extends AbstractAccessorTest
{
	const ACCESSOR_CLASS = 'Clio\Component\Util\Accessor\ObjectAccessor';

	protected function getDefaultData()
	{
		return new Models\AccessorTestModel();
	}

	/**
	 * createAccessor 
	 * 
	 * @param mixed $data 
	 * @access protected
	 * @return void
	 */
	protected function createAccessor($data = null)
	{
		if(!$data) {
			$data = $this->getDefaultData();
		}

		$class = self::ACCESSOR_CLASS;
		return new $class($this->createClassAccessor($data), $data);
	}

	protected function createClassAccessor($data)
	{
		$classReflector = new \ReflectionClass($data);

		return new SimpleSchemaAccessor($classReflector, array(
			'foo'  => new PublicPropertyFieldAccessor('foo', $classReflector->getProperty('foo')),
			'bar'  => new MethodFieldAccessor('bar', $classReflector->getMethod('getBar'), $classReflector->getMethod('setBar')),
			'hoge' => new MethodFieldAccessor('hoge', $classReflector->getMethod('getHoge'), $classReflector->getMethod('setHoge')),
		));
	}
}

