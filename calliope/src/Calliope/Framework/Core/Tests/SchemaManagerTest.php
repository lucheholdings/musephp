<?php
namespace Calliope\Framework\Core\Tests;

use Calliope\Framework\Core\Factory\SchemaFactory;
use Clio\Component\Schemifier\Factory\SerializerSchemifierFactory;
use Clio\Component\Serializer;
use Clio\Component\Serializer\Tool\ArrayParser;
use Calliope\Framework\Core\Metadata\ClassMetadataFactory;
use Calliope\Framework\Core\Connection\TypedConnectionFactory;
use Calliope\Framework\Core\Connection\ProxyManagerConnectionFactory;

class SchemaManagerTest extends \PHPUnit_Framework_TestCase
{
	protected $classMetadata;
	protected $manager;
	protected $schemeFactory;

	public function testCreate()
	{
		$manager = $this->getSchemaManager();
	}

	/**
	 * testSchemify 
	 * 
	 * @access public
	 * @return void
	 */
	public function testSchemify()
	{
		$manager = $this->getSchemaManager();

		$data = array(
			'name' => 'foo',
			'label' => 'Foo',
		);

		// Schemify the data
		$model = $manager->schemify($data);

		$this->assertInstanceOf($this->classMetadata->getNamespacedName(), $model);

		$this->assertEquals($data['label'], $model->getLabel());
		$this->assertEquals($data['name'], $model->getName());
	}

	/**
	 * getSchemaClass 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getSchemaClass()
	{
		return 'Calliope\Framework\Core\Tests\TestModel';
	}


	protected function getSchemaClassMetadata()
	{
		if(!$this->classMetadata) {
			$this->classMetadata = ClassMetadataFactory::createFactory()->create($this->getSchemaClass());
		}

		return $this->classMetadata;
	}

	public function getManagerRegistry()
	{
	}

	protected function getSchemaFactory()
	{
		if(!$this->schemeFactory) {
			$this->schemeFactory = new SchemaFactory();

			$arrayParser = new ArrayParser(array(
			));
			$this->schemeFactory
				->setSchemifierFactory(
					new SerializerSchemifierFactory(new Serializer\Serializer(new Serializer\Strategy\CompositeStrategy(array(
						new Serializer\Strategy\ArraySerializableStrategy(),
						new Serializer\Strategy\InternalArrayStrategy($arrayParser),
						new Serializer\Strategy\StdClassSerializationStrategy($arrayParser)
					))))
			);
		}
		return $this->schemeFactory;
	}

	protected function getSchemaManager()
	{
		if(!$this->manager) {
			$classMetadata = $this->getSchemaClassMetadata();
			$this->manager = $this->getSchemaFactory()->createManager($classMetadata);
		}

		return $this->manager;
	}
}

