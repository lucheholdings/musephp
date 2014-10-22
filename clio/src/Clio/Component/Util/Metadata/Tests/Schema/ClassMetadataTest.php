<?php
namespace Clio\Component\Util\Metadata\Tests\Schema;

use Clio\Component\Util\Metadata\Schema\ClassMetadata;

class ClassMetadataTest extends SchemaMetadataTestCase
{
	private $schema;

	public function getTestSchemaName()
	{
		return $this->schema->getName();
	}

	public function getTestSchema()
	{
		if(!$this->schema) 
			$this->schema = new \ReflectionClass('Clio\Component\Util\Metadata\Tests\Models\TestModel');

		return $this->schema;
	}

	public function createMetadata($schema)
	{
		return new ClassMetadata($schema);
	}
}

