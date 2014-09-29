<?php
namespace Clio\Component\Pce\FieldAccessor\Tests\Property;

use Clio\Component\Pce\FieldAccessor\Mapping\BasicClassMapping;

use Clio\Component\Pce\FieldAccessor\Tests\TestModel;
use Clio\Component\Pce\FieldAccessor\Property\MethodPropertyFieldAccessor;

class MethodPropertyFieldAccessorTest extends PropertyFieldAccessorTestCase 
{
	public function testGetField()
	{
		$this->assertEquals($this->getField(), $this->getAccessor()->getField());
	}

	public function testGetValue()
	{
		$model = $this->createModel();
		$model->setPrivateField('foo');

		$value = $this->getAccessor()->get($model, $this->getField());
		$this->assertEquals('foo', $value);

		$value = $this->getAccessor()->getValue($model);
		$this->assertEquals('foo', $value);
	}

	public function testSetter()
	{
		$model = $this->createModel();

		$value = $this->getAccessor()->set($model, $this->getField(), 'foo');
		$this->assertEquals('foo', $model->getPrivateField());

		$value = $this->getAccessor()->setValue($model, 'bar');
		$this->assertEquals('bar', $model->getPrivateField());
	}

	public function testIsNull()
	{
		$model = $this->createModel();
		$model->setPrivateField('foo');
		
		$isExists = $this->getAccessor()->isNull($model, $this->getField());
		$this->assertFalse($isExists);
		$isExists = $this->getAccessor()->isValueNull($model);
		$this->assertFalse($isExists);

		$model->setPrivateField(null);
		$isExists = $this->getAccessor()->isValueNull($model);
		$this->assertTrue($isExists);
	}

	public function testClear()
	{
		$model = $this->createModel();

		$model->setPrivateField('foo');
		$this->getAccessor()->clear($model, $this->getField());
		$this->assertNull($model->getPrivateField());

		$model->setPrivateField('foo');
		$this->getAccessor()->clearValue($model);
		$this->assertNull($model->getPrivateField());
	}

	protected function createModel()
	{
		return new TestModel();
	}

	protected function getField()
	{
		return 'privateField';
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
			$this->accessor = new MethodPropertyFieldAccessor($classMapping, $this->getField());
		}

		return $this->accessor;
	}
}

