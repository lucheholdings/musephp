<?php
namespace Clio\Component\Tool\Normalizer\Tests\Type;

use Clio\Component\Tool\Normalizer\Type\ReflectionClassType;
use Clio\Component\Tool\Normalizer\Tests\Models;

class ReflectionClassTypeTest extends \PHPUnit_Framework_TestCase
{
	private $data;

	public function testObject()
	{
		$data = $this->getData();
		$type = $this->createType($data);

		$this->assertEquals(get_class($data), $type->getName());
		$this->assertEquals(get_class($data), (string)$type);
		

		$this->assertInstanceof(get_class($data), $type->construct());

		$this->assertInstanceof('ReflectionClass', $type->getClassReflector());

		$this->assertFalse($type->canReference());
		$this->assertEmpty($type->getIdentifierFields());
		$this->assertEmpty($type->getIdentifierValues($data));
		$this->assertNull($type->getFieldType('value'));
		
		$data->setIdentifier(1);
		$type->setIdentifierFields(array('identifier'));
		$type->setFieldType('value', 'string');

		$this->assertTrue($type->canReference());
		$this->assertContains('identifier', $type->getIdentifierFields());
		$this->assertEquals(array('identifier' => 1), $type->getIdentifierValues($data));
		$this->assertEquals('string', $type->getFieldType('value'));
		

	}

	protected function createType($data)
	{
		return new ReflectionClassType(new \ReflectionClass($data));
	}

	protected function getData()
	{
		if(!$this->data) {
			$this->data = new Models\TestModel();
		}
		return $this->data;
	}
}

