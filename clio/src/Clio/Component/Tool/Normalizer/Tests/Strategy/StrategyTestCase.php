<?php
namespace Clio\Component\Tool\Normalizer\Tests\Strategy;
use Clio\Component\Tool\Normalizer\Context;

abstract class StrategyTestCase extends \PHPUnit_Framework_TestCase
{
	public function testNormalize()
	{
		$strategy = $this->createStrategy();
		$context  = $this->createContext();
		$data = $this->getTestData();
		$type = $this->createType($data);

		$normalized = $strategy->normalize($data, $type, $context);
		$this->assertEquals($this->getResultData(), $normalized);
	}

	protected function createContext()
	{
		return new Context();
	}
}


