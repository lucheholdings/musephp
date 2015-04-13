<?php
namespace Clio\Component\Tool\Normalizer\Tests\Strategy;

use Clio\Component\Tool\Normalizer\Strategy\ScalarStrategy;
use Clio\Component\Tool\Normalizer\Type\NormalizerType;
use Clio\Component\Util\Type\Actual as ActualTypes;
use Clio\Component\Util\Type as Types;

class ScalarStrategyTest extends StrategyTestCase 
{
	private $testData;

	private $testTypeName;

	public function testNormalize()
	{
		return;
	}

	public function testNormalizeString()
	{
		$this->testData = 'Foo';
		$this->testTypeName = 'string';
		parent::testNormalize();
	}

	public function testNormalizeInt()
	{
		$this->testData = 1;
		$this->testTypeName = Types\PrimitiveTypes::TYPE_INT;
		parent::testNormalize();
	}

    public function testDenormalize()
    {
        return ;
    }

	protected function createStrategy()
	{
		return new ScalarStrategy();
	}

	protected function getTestData()
	{
		return $this->testData;
	}

	protected function getResultData()
	{
		return $this->testData;
	}

	protected function createType($data)
	{
		return new NormalizerType(new ActualTypes\ScalarType(gettype($data)));
	}

	protected function getTestTypeName()
	{
		return $this->testTypeName;
	}
}

