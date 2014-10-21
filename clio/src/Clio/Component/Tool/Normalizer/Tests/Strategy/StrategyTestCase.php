<?php
namespace Clio\Component\Tool\Normalizer\Tests\Strategy;

use Clio\Component\Tool\Normalizer\Normalizer;
use Clio\Component\Tool\Normalizer\Context;
use Clio\Component\Tool\Normalizer\Strategy\StrategyCollection,
	Clio\Component\Tool\Normalizer\Strategy\ScalarStrategy,
	Clio\Component\Tool\Normalizer\Strategy\ReferenceStrategy
;

abstract class StrategyTestCase extends \PHPUnit_Framework_TestCase
{
	private $normalizer;

	private $context;

	public function testNormalize()
	{
		$data = $this->getTestData();
		$type = $this->createType($data);

		$normalizer = $this->getNormalizer();
		$normalized = $normalizer->normalize($data, $type, $this->getContext());

		$this->assertEquals($this->getResultData(), $normalized);
	}

	protected function initNormalizer()
	{
		$strategy = $this->createStrategy();
		if(!$strategy instanceof ScalarStrategy) {
			$strategy = new StrategyCollection(array(
				$strategy,
				new ScalarStrategy(),
				new ReferenceStrategy(),
			));
		}
		
		$this->normalizer = new Normalizer($strategy);
		$this->context = new Context();
		$this->context->setNormalizer($this->normalizer);
	}

	protected function getNormalizer()
	{
		if(!$this->normalizer) {
			$this->initNormalizer();
		}
	
		return $this->normalizer;
	}

	protected function getContext()
	{
		if(!$this->context) {
			$this->initNormalizer();
		}
		return $this->context;
	}

	abstract protected function createStrategy();

	protected function createType($data)
	{
		return $this->getContext()->getTypeRegistry()->guessType($data);
	}
	
	abstract protected function getTestData();

	abstract protected function getResultData();

}

