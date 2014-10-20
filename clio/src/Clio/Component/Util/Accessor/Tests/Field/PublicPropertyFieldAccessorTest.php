<?php
namespace Clio\Component\Util\Accessor\Tests\Field;

use Clio\Component\Util\Accessor\Field\PublicPropertyFieldAccessor;
use Clio\Component\Util\Accessor\Tests\Models;

class PublicPropertyFieldAccessorTest extends FieldAccessorTestCase
{
	private $data;

	protected function getData()
	{
		if(!$this->data) {
			$this->data = new Models\AccessorTestModel();
		}
		return $this->data;
	}

	protected function getBasicTestField()
	{
		return 'foo';
	}

	protected function getFieldData($field)
	{
		return $this->getData()->{'get' . ucfirst($field)}();
	}

	protected function createFieldAccessor($field, $data = null)
	{
		if(!$data) {
			$data = $this->getData();
		}
		$reflector = new \ReflectionObject($data);

		return new PublicPropertyFieldAccessor($field, $reflector->getProperty($field));
	}
}

