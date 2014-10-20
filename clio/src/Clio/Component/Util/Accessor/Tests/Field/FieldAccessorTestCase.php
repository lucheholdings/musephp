<?php
namespace Clio\Component\Util\Accessor\Tests\Field;

abstract class FieldAccessorTestCase extends \PHPUnit_Framework_TestCase 
{
	public function testBasic()
	{
		$field = $this->getBasicTestField();

		if(!$field) {
			return;
		}
		$data = $this->getData();

		$fieldAccessor = $this->createFieldAccessor($field);

		$this->assertFalse($fieldAccessor->isNull($data));
		$this->assertEquals($this->getFieldData($field), $fieldAccessor->get($data));

		$fieldAccessor->set($data, 'newValue');
		$this->assertEquals('newValue', $fieldAccessor->get($data));

		$fieldAccessor->clear($data);
		$this->assertTrue($fieldAccessor->isNull($data));
	}

	abstract protected function getBasicTestField();

	abstract protected function getData();

	protected function getFieldData($field)
	{
		return $this->getData()[$field];
	}

	abstract protected function createFieldAccessor($field);
}

