<?php
namespace Clio\Component\Pce\FieldAccessor\Tests;

use Clio\Component\Pce\FieldAccessor\Mapping\BasicClassMapping;

use Clio\Component\Pce\FieldAccessor\PropertyFieldCollectionAccessor;
use Clio\Component\Pce\FieldAccessor\Property\MethodPropertyFieldAccessor;
use Clio\Component\Pce\FieldAccessor\Property\PublicPropertyFieldAccessor;

class PropertyFieldCollectionAccessorTest extends PropertyAccessorTestCase 
{
	public function testHasAccessor()
	{
		$accessor = $this->getAccessor();

		$this->assertTrue($accessor->hasFieldAccessor('publicField'));
		$this->assertTrue($accessor->hasFieldAccessor('privateField'));
		$this->assertFalse($accessor->hasFieldAccessor('falseField'));
	}

	public function testGetAccessor()
	{
		$accessor = $this->getAccessor();

		$this->assertInstanceof('Clio\Component\Pce\FieldAccessor\Property\PublicPropertyFieldAccessor', $accessor->getFieldAccessor('publicField'));
	}

	public function testSet()
	{
		$accessor = $this->getAccessor();

		$model = $this->createModel();

		$accessor->set($model, 'publicField', 'foo');
		$accessor->set($model, 'privateField', 'bar');


		$this->assertEquals('foo', $model->publicField);
		$this->assertEquals('bar', $model->getPrivateField());
	}

	protected function getAccessor()
	{
		if(!$this->accessor) {
			$classMapping = new BasicClassMapping(new \ReflectionClass($this->createModel()));

			$this->accessor = new PropertyFieldCollectionAccessor($classMapping);

			$this->accessor
				->addFieldAccessor(new PublicPropertyFieldAccessor($classMapping, 'publicField'))
				->addFieldAccessor(new MethodPropertyFieldAccessor($classMapping, 'privateField'))
			;
		}

		return $this->accessor;
	}

	protected function createModel()
	{
		return new TestModel();
	}
}

