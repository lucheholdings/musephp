<?php
namespace Erato\Core\Tests\Schema\Mapping\Factory;

use Erato\Core\Schema\Mapping\Factory\NormalizerMappingFactory;
use Clio\Component\Schema\Schema\ClassSchema;

use Clio\Component\Normalizer\Normalizer;
use Clio\Component\Normalizer\Strategy\PriorityCollection;

class NormalizerMappingFatoryTest extends MappingFactoryTest 
{
	protected function getMappingClass()
	{
		return 'Erato\Core\Schema\Mapping\NormalizerMapping';
	}

	protected function getSchema()
	{
		return new ClassSchema(new \ReflectionClass('Erato\Core\Tests\Models\Model01'));
	}

	protected function getFactory()
	{
		return new NormalizerMappingFactory($this->getNormalizer());
	}

	protected function getNormalizer()
	{

		$strategy = new PriorityCollection();
		return new Normalizer($strategy);
	}
}

