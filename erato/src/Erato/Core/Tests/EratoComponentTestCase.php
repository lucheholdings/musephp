<?php
namespace Erato\Core\Tests;

use Clio\Component\Metadata\Metadata;
use Clio\Component\Metadata\Schema\ClassMetadata;

abstract class EratoComponentTestCase extends \PHPUnit_Framework_TestCase 
{
	protected function createMetadata($schema)
	{
		if(is_string($schema)) {
			if(class_exists($schema)) {
				return new ClassMetadata(new \ReflectionClass($schema));
			}
		} else if($schema instanceof Metadata) {
			return $schema;
		} else if($schema instanceof \ReflectionClass) {
			return new ClassMetadata($schema);
		}

		throw new \Exception('Failed to create Metadata.');
	}
}

