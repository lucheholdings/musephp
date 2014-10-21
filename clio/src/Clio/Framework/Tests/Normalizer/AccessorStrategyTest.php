<?php
namespace Clio\Framework\Tests\Normalizer;

use Clio\Framework\Normalizer\Strategy\AccessorStrategy;
use Clio\Component\Tool\Normalizer\Tests\Strategy\StrategyTestCase;
use Clio\Component\Util\Accessor\Factory\BasicClassAccessorFactory;
use Clio\Framework\Tests\Models;

class AccessorStrategyTest extends StrategyTestCase 
{
	private $testData;

	private $testResult;

	private $testType;

	public function testNormalize()
	{
		return;
	}

	public function testSimpleClass()
	{
		$this->testData   = new Models\NormalizerTestModel('Foo', 'Bar', 'Hoge');
		$this->testResult = array(
				'foo'  => 'Foo',
				'bar'  => 'Bar',
				'hoge' => 'Hoge',
			);
		parent::testNormalize();
	}

	public function testComplex()
	{
		$this->testData   = new Models\NormalizerComplexTestModel(1, 'Foo', 'Bar', 'Hoge');
		$this->testResult = array(
				'id'    => 1,
				'self'  => array('id' => 1),
				'child' => array(
					'foo'  => 'Foo',
					'bar'  => 'Bar',
					'hoge' => 'Hoge',
				),
			);

		$type = $this->createType($this->testData);

		$type->setIdentifierFields(array('id'));

		parent::testNormalize();
	}

	protected function createStrategy()
	{
		return new AccessorStrategy(BasicClassAccessorFactory::createDefaultFactory());
	}

	protected function getTestData()
	{
		return $this->testData;
	}

	protected function getResultData()
	{
		return $this->testResult;
	}
}

