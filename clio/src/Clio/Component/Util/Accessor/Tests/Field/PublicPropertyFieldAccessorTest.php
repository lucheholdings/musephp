<?php
namespace Clio\Component\Util\Accessor\Tests\Field;

use Clio\Component\Util\Accessor\Field\PublicPropertyFieldAccessor;
use Clio\Component\Util\Accessor\Tests\Models;

class PublicPropertyFieldAccessorTest extends \PHPUnit_Framework_TestCase 
{
	public function testGet()
	{
		$model = $this->getDefaultData();

		$fieldAccessor = $this->createFieldAccessor('foo', $model);
		$this->assertFalse($fieldAccessor->isNull($model));
		$this->assertEquals('Foo', $fieldAccessor->get($model));
	}

	public function testSet()
	{
		$model = $this->getDefaultData();

		$fieldAccessor = $this->createFieldAccessor('foo', $model);
		$this->assertEquals('Foo', $fieldAccessor->get($model));

		$fieldAccessor->set($model, 'Bar');
		$this->assertEquals('Bar', $fieldAccessor->get($model));

		$fieldAccessor->clear($model);
		$this->assertTrue($fieldAccessor->isNull($model));

	}

	protected function getDefaultData()
	{
		return new Models\AccessorTestModel();
	}

	protected function createFieldAccessor($field, $data = null)
	{
		if(!$data) {
			$data = $this->getDefaultData();
		}
		$reflector = new \ReflectionObject($data);

		return new PublicPropertyFieldAccessor($field, $reflector->getProperty($field));
	}
}

