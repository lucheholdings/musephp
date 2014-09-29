<?php
namespace Clio\Component\Util\FieldAccessor\Tests\Builder;

use Clio\Component\Util\FieldAccessor\Tests\Models;
use Clio\Component\Util\FieldAccessor\Builder\LayerFieldAccessorBuilder;
use Clio\Component\Util\FieldAccessor\Mapping\Factory\BasicMappingFactory;
use Clio\Component\Util\FieldAccessor\Factory\PropertyFieldCollectionAccessorFactory;

class LayerFieldAccessorBuilderTest extends \PHPUnit_Framework_TestCase 
{
	public function testsBuild()
	{
		$model = new Models\TestModel01();

		$mapping = $this->getMappingFactory()->createClassMapping(new \ReflectionClass($model));
		$builder = $this->createBuilder();
		$builder->setClassMapping($mapping);

		$accessor = $builder->build();
	}

	private $mappingFactory;

	private $propertyAccessorFactory;
	
	public function createBuilder()
	{
		$builder = new LayerFieldAccessorBuilder();

		$builder
			->addLayerFactory($this->getPropertyFieldAccessorFactory());
		;

		return $builder;
	}

	public function getPropertyFieldAccessorFactory()
	{
		if(!$this->propertyAccessorFactory) {
			$this->propertyAccessorFactory = new PropertyFieldCollectionAccessorFactory();
			PropertyFieldCollectionAccessorFactory::addDefaultFactories($this->propertyAccessorFactory);
		}

		return $this->propertyAccessorFactory;
	}

	public function getMappingFactory()
	{
		if(!$this->mappingFactory) {
			$this->mappingFactory = new BasicMappingFactory();
		}

		return $this->mappingFactory;
	}
}

