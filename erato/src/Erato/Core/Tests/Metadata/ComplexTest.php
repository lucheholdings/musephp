<?php
namespace Erato\Core\Tests;

use Erato\Core\Metadata\Mapping\Factory as MappingFatory;

class ComplexTest extends \PHPUnit_Framework_TestCase 
{
	private $managerRegistry;

	private $metadataFactory;

	private $metadataRegistry;

	private $normalizer;

	public function testSuccess()
	{
		$manager = $this->getManagerRegistry()->get('Erato\Core\Tests\Models\Model01');

		$model = $manager->construct();

		$manager->schemify(array('private_'));
	}

	protected function getManagerRegistry()
	{
		if(!$this->managerRegistry)
			$this->managerRegistry = new ManagerRegistry($this->getMetadataRegistry());

		return $this->managerRegistry;
	}
	

	protected function getMetadataRegistry()
	{
		if(!$this->metadataRegistry)
			$this->metadataRegistry = new MetadataRegistry($this->getMetadataFactory());
		return $this->metadataRegistry;
	}

	protected function getMetadataFactory()
	{
		if(!$this->metadataFactory) {
			$mappingFactory = new FactoryCollection(array(
				'accessor'   => new MappingFactory\AccessorMappingFactory(),
				'normalizer' => new MappingFactory\NormalizerMappingFactory($this->getNormalizer()),
				'attributes' => new MappingFactory\AttributeMapMappingFactory(),
				'tags'       => new MappingFactory\TagSetMappingFactory(),
			)); 
			$this->metadataFactory = new ClassMetadataFactory($mappingFactory);
		}

		return $this->metadataFactory;
	}

	protected function getNormalizer()
	{
		if(!$this->normalizer) {
			$strategy = new StrategyCollection();
			$strategy->initDefaultStrategies();

			$this->normalizer = new Normalizer($strategy);
		}

		return $this->normalizer;
	}
}

