<?php
namespace Erato\Core\Tests\Schema\Mapping;

use Erato\Core\Tests\EratoComponentTestCase;
use Erato\Core\Schema\Mapping\SchemaAccessorMapping;
use Erato\Core\Tests\Models;

use Clio\Component\Util\Accessor\Schema\Factory\BasicClassAccessorFactory;

class SchemaAccessorMappingTest extends EratoComponentTestCase
{
	public function testObject()
	{
		$metadata = $this->createSchema('Erato\Core\Tests\Models\Model01');
		$mapping = $metadata->getMapping('accessor');

		$model = new Models\Model01();

		$accessor = $mapping->getAccessor();
		$this->assertInstanceOf('Clio\Component\Util\Accessor\SchemaAccessor', $accessor);


		$dataAccessor = $mapping->createDataAccessor($model);
		$this->assertInstanceOf('Clio\Component\Util\Accessor\SchemaDataAccessor', $dataAccessor);
	}

	protected function createSchema($schema)
	{
		$metadata = parent::createSchema($schema);

		$this->addMapping($metadata);
		return $metadata;
	}

	protected function addMapping($metadata)
	{
		if(!$metadata->hasMapping('accessor')) {
			$mapping = new SchemaAccessorMapping($metadata);
			$mapping->setAccessorFactory($this->getAccessorFactory());

			$metadata->getMappings()->addMapping($mapping);
		}
	}

	protected function getAccessorFactory()
	{
		return BasicClassAccessorFactory::createFactory();
	}
}

