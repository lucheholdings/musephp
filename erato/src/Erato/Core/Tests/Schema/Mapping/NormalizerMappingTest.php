<?php
namespace Erato\Core\Tests\Schema\Mapping;

use Erato\Core\Schema\Mapping\NormalizerMapping;
use Clio\Component\Util\Schema\Schema\ClassSchema;

use Clio\Component\Tool\Normalizer\Normalizer;
use Clio\Component\Tool\Normalizer\Strategy\PriorityCollection,
	Clio\Component\Tool\Normalizer\Strategy\ArrayAccessStrategy;
use Erato\Core\Tests\Models;

class NormalizerMappingFatoryTest extends \PHPUnit_Framework_TestCase
//class NormalizerMappingFatoryTest extends MappingTest
{
	public function testNormalize()
	{
		$mapping = $this->getMapping();

		$model = new Models\Model01();
		$model->setPrivateVariable('private');
		$model->setProtectedVariable('protected');
		$model->publicVariable = 'public';


		$normalized = $mapping->normalize($model);

		$this->assertEquals('private', $normalized['privateVariable']);
		$this->assertEquals('protected', $normalized['protectedVariable']);
		$this->assertEquals('public', $normalized['publicVariable']);

		$denormalized = $mapping->denormalize($normalized);

		$this->assertEquals('private', $denormalized->getPrivateVariable());
		$this->assertEquals('protected', $denormalized->getProtectedVariable());
		$this->assertEquals('public', $denormalized->publicVariable);
	}

	protected function getSchema()
	{
		return new ClassSchema(new \ReflectionClass('Erato\Core\Tests\Models\Model01'));
	}

	protected function getMapping()
	{
		$mapping = new NormalizerMapping($this->getSchema());
		$mapping->setNormalizer($this->getNormalizer());


		return $mapping;
	}

	protected function getNormalizer()
	{
		$strategy = new PriorityCollection();
		$strategy->initDefaultStrategies();
		$strategy->addStrategy(new ArrayAccessStrategy());

		return new Normalizer($strategy);
	}
}

