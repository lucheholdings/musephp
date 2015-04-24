<?php
namespace Erato\Core\Tests;

//use Erato\Core\Schema\Mapping\Factory as MappingFactory;
use Erato\Core\ManagerRegistry;
use Erato\Core\Schema\SchemaRegistry;

use Clio\Extra\Accessor\Schema\Factory\SchemaSchemaAccessorFactory;

use Clio\Component\Util\Schema\Schema\Factory\ClassSchemaFactory,
	Clio\Component\Util\Schema\Mapping\Factory as CoreMappingFactory,
	Clio\Extra\Schema\Mapping\Factory as ExtraMappingFactory
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
			$this->managerRegistry = new ManagerRegistry($this->getSchemaRegistry());

		return $this->managerRegistry;
	}
	

	protected function getSchemaRegistry()
	{
		if(!$this->metadataRegistry)
			$this->metadataRegistry = new SchemaRegistry($this->getSchemaFactory());
		return $this->metadataRegistry;
	}

	protected function getSchemaFactory()
	{
		if(!$this->metadataFactory) {
			$mappingFactory = new CoreMappingFactory\Collection(array(
				'accessor'   => new ExtraMappingFactory\AccessorMappingFactory($this->getAccessorFactory()),
				'normalizer' => new ExtraMappingFactory\NormalizerMappingFactory($this->getNormalizer()),
				'attributes' => new ExtraMappingFactory\AttributeMapMappingFactory(),
				'tags'       => new ExtraMappingFactory\TagSetMappingFactory(),
			)); 
			$this->metadataFactory = new ClassSchemaFactory($mappingFactory);
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
		return SchemaSchemaAccessorFactory::createFactory();
	}
}

