<?php
namespace Erato\Core\Tests\Schema\Mapping\Factory;

use Erato\Core\Tests\TestSchemaRegistry;
use Clio\Component\Pce\Schema\BasicClassSchemaFactory;

abstract class MappingFactoryTestCase extends \PHPUnit_Framework_TestCase
{
	private $schemaRegistry;

	public function testBasic()
	{
		$factory = $this->getFactory();
		$metadata = $this->getSchema();

		$mapping = $factory->createMapping($metadata);

		$this->assertInstanceof($this->getMappingClass(), $mapping);
	}

	abstract protected function getSchema();

	abstract protected function getMappingClass();

	abstract protected function getFactory();

    public function getSchemaRegistry()
    {
        if(!$this->schemaRegistry) {
            $this->schemaRegistry = new TestSchemaRegistry();
        }
        return $this->schemaRegistry;
    }
}

