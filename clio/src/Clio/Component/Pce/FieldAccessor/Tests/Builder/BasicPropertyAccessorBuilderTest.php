<?php
namespace Clio\Component\Pce\FieldAccessor\Tests\Builder;

use Clio\Component\Pce\FieldAccessor\Tests\Models;
use Clio\Component\Pce\FieldAccessor\Builder\LayerFieldAccessorBuilder;
use Clio\Component\Pce\FieldAccessor\Mapping\Factory\BasicMappingFactory;
use Clio\Component\Pce\FieldAccessor\Factory\PropertyFieldCollectionAccessorFactory;

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
			->addLayer($this->getPropertyFieldAccessorFactory());
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

