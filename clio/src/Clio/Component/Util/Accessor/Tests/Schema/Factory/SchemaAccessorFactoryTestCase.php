<?php
namespace Clio\Component\Util\Accessor\Tests\Factory;

abstract class SchemaAccessorFactoryTestCase extends \PHPUnit_Framework_TestCase
{
	public function testCreate()
	{
		$accessor = $this->createFactory()->createSchemaAccessor($this->getSchema());

		$this->assertInstanceof($this->getAccessorClass(), $accessor);
	}

	abstract protected function getAccessorClass();

	abstract protected function createFactory();

	abstract protected function getSchema();
}

