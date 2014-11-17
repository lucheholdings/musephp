<?php
namespace Erato\Core\Tests\Metadata\Mapping\Factory;

use Erato\Core\Metadata\Mapping\Factory\NormalizerMappingFactory;
use Clio\Component\Util\Metadata\Schema\ClassMetadata;

use Clio\Component\Tool\Normalizer\Normalizer;
use Clio\Component\Tool\Normalizer\Strategy\PriorityCollection;

class NormalizerMappingFatoryTest extends MappingFactoryTest 
{
	protected function getMappingClass()
	{
		return 'Erato\Core\Metadata\Mapping\NormalizerMapping';
	}

	protected function getMetadata()
	{
		return new ClassMetadata(new \ReflectionClass('Erato\Core\Tests\Models\Model01'));
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

