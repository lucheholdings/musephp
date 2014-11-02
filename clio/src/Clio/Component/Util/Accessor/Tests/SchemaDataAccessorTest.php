<?php
namespace Clio\Component\Util\Accessor\Tests;

use Clio\Component\Util\Accessor\Tests\Models;
use Clio\Component\Util\Accessor\Schema\SimpleSchemaAccessor;
use Clio\Component\Util\Accessor\Schema\ClassSchema;
use Clio\Component\Util\Accessor\Field;

class SchemaDataAccessorTest extends AbstractAccessorTest
{
	const ACCESSOR_CLASS = 'Clio\Component\Util\Accessor\SchemaDataAccessor';

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
		$schemaAccessor = $this->createClassAccessor($data);
		return new $class($schemaAccessor, $data);
	}

	protected function createClassAccessor($data)
	{
		$classReflector = new \ReflectionClass($data);
		$schema = new ClassSchema($classReflector);

		return new SimpleSchemaAccessor($schema, new Field\NamedCollection(array(
			'foo'  => new Field\PublicPropertyFieldAccessor('foo', $classReflector->getProperty('foo')),
			'bar'  => new Field\MethodFieldAccessor('bar', $classReflector->getMethod('getBar'), $classReflector->getMethod('setBar')),
			'hoge' => new Field\MethodFieldAccessor('hoge', $classReflector->getMethod('getHoge'), $classReflector->getMethod('setHoge')),
		)));
	}
}

