<?php
namespace Clio\Component\Util\FieldAccessor\Tests\Property;

use Clio\Component\Util\FieldAccessor\Mapping\BasicClassMapping;

use Clio\Component\Util\FieldAccessor\Tests\TestModel;
use Clio\Component\Util\FieldAccessor\Property\PublicPropertyFieldAccessor;

class PublicPropertyFieldAccessorTest extends PropertyFieldAccessorTestCase 
{
	public function testGetField()
	{
		$this->assertEquals($this->getField(), $this->getAccessor()->getField());
	}

	public function testGetValue()
	{
		$model = $this->createModel();
		$model->publicField = 'foo';

		$value = $this->getAccessor()->get($model, $this->getField());
		$this->assertEquals('foo', $value);

		$value = $this->getAccessor()->getValue($model);
		$this->assertEquals('foo', $value);
	}

	public function testSetter()
	{
		$model = $this->createModel();

		$value = $this->getAccessor()->set($model, $this->getField(), 'foo');
		$this->assertEquals('foo', $model->publicField);

		$value = $this->getAccessor()->setValue($model, 'bar');
		$this->assertEquals('bar', $model->publicField);
	}

	public function testIsNull()
	{
		$model = $this->createModel();
		$model->publicField = 'foo';
		
		$isExists = $this->getAccessor()->isNull($model, $this->getField());
		$this->assertFalse($isExists);
		$isExists = $this->getAccessor()->isValueNull($model);
		$this->assertFalse($isExists);

		$model->publicField = null;
		$isExists = $this->getAccessor()->isValueNull($model);
		$this->assertTrue($isExists);
	}

	public function testClear()
	{
		$model = $this->createModel();

		$model->publicField = 'foo';
		$this->getAccessor()->clear($model, $this->getField());
		$this->assertNull($model->publicField);

		$model->publicField = 'foo';
		$this->getAccessor()->clearValue($model);
		$this->assertNull($model->publicField);
	}

	protected function createModel()
	{
		return new TestModel();
	}

	protected function getField()
	{
		return 'publicField';
	}

	/**
	 * getAccessor 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getAccessor()
	{
		if(!$this->accessor) {
			$classMapping = new BasicClassMapping(new \ReflectionClass($this->createModel()));
			$this->accessor = new PublicPropertyFieldAccessor($classMapping, $this->getField());
		}

		return $this->accessor;
	}
}

