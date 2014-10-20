<?php
namespace Clio\Component\Util\Accessor\Tests\Field\Factory;

abstract class FieldAccessorFactoryTestCase extends \PHPUnit_Framework_TestCase
{
	public function testCreate()
	{
		$accessor = $this->createFactory()->createFieldAccessor($this->getTestSchema(), $this->getTestFieldName());

		$this->assertInstanceof($this->getAccessorClass(), $accessor);
	}

	abstract protected function getAccessorClass();

	abstract protected function createFactory();

	abstract protected function getTestSchema();

	abstract protected function getTestFieldName();
}

