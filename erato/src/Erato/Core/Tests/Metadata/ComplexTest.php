<?php
namespace Erato\Core\Tests;

//use Erato\Core\Metadata\Mapping\Factory as MappingFactory;
use Erato\Core\ManagerRegistry;
use Erato\Core\Metadata\MetadataRegistry;

use Clio\Extra\Accessor\Schema\Factory\SchemaMetadataAccessorFactory;

use Clio\Component\Util\Metadata\Schema\Factory\ClassMetadataFactory,
	Clio\Component\Util\Metadata\Mapping\Factory as CoreMappingFactory,
	Clio\Extra\Metadata\Mapping\Factory as ExtraMappingFactory
;

class ComplexTest extends \PHPUnit_Framework_TestCase 
{
	private $managerRegistry;

	private $metadataFactory;

	private $metadataRegistry;

	private $normalizer;

	public function testSuccess()
	{
		$manager = $this->getManagerRegistry()->createManager('Erato\Core\Tests\Models\Model01');

		$model = $manager->create();

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
			$mappingFactory = new CoreMappingFactory\Collection(array(
				'accessor'   => new ExtraMappingFactory\AccessorMappingFactory($this->getAccessorFactory()),
				'normalizer' => new ExtraMappingFactory\NormalizerMappingFactory($this->getNormalizer()),
				'attributes' => new ExtraMappingFactory\AttributeMapMappingFactory(),
				'tags'       => new ExtraMappingFactory\TagSetMappingFactory(),
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

	public function getAccessorFactory()
	{
		return SchemaMetadataAccessorFactory::createFactory();
	}
}

