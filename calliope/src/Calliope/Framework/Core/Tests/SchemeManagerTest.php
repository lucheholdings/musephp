<?php
namespace Calliope\Framework\Core\Tests;

use Calliope\Framework\Core\Factory\SchemeFactory;
use Clio\Component\Schemifier\Factory\SerializerSchemifierFactory;
use Clio\Component\Serializer;
use Clio\Component\Serializer\Tool\ArrayParser;
use Calliope\Framework\Core\Metadata\ClassMetadataFactory;
use Calliope\Framework\Core\Connection\TypedConnectionFactory;
use Calliope\Framework\Core\Connection\ProxyManagerConnectionFactory;

class SchemeManagerTest extends \PHPUnit_Framework_TestCase
{
	protected $classMetadata;
	protected $manager;
	protected $schemeFactory;

	public function testCreate()
	{
		$manager = $this->getSchemeManager();
	}

	/**
	 * testSchemify 
	 * 
	 * @access public
	 * @return void
	 */
	public function testSchemify()
	{
		$manager = $this->getSchemeManager();

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
	 * getSchemeClass 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getSchemeClass()
	{
		return 'Calliope\Framework\Core\Tests\TestModel';
	}


	protected function getSchemeClassMetadata()
	{
		if(!$this->classMetadata) {
			$this->classMetadata = ClassMetadataFactory::createFactory()->create($this->getSchemeClass());
		}

		return $this->classMetadata;
	}

	public function getManagerRegistry()
	{
	}

	protected function getSchemeFactory()
	{
		if(!$this->schemeFactory) {
			$this->schemeFactory = new SchemeFactory();

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

	protected function getSchemeManager()
	{
		if(!$this->manager) {
			$classMetadata = $this->getSchemeClassMetadata();
			$this->manager = $this->getSchemeFactory()->createManager($classMetadata);
		}

		return $this->manager;
	}
}

