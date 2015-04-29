<?php
namespace Clio\Component\Normalizer\Tests;

use Clio\Component\Normalizer\Context;

abstract class StrategyTestCase extends \PHPUnit_Framework_TestCase
{
    private $context;

    protected $strategy;

    protected $type;

    protected $normalizedData;

    protected $denormalizedData;

    protected function doTestNormalize()
    {
        $strategy = $this->getStrategy();

        $normalized = $strategy->normalize($this->getDenormalizedData(), $this->getType(), $this->getContext());

        $this->assertEquals($this->getNormalizedData(), $normalized);
    }

    protected function doTestDenormalize()
    {
        $strategy = $this->getStrategy();

        $denormalized = $strategy->denormalize($this->getNormalizedData(), $this->getType(), $this->getContext());

        $this->assertEquals($this->getDenormalizedData(), $denormalized);
    }

    public function getContext()
    {
        if(!$this->context) {
            $this->context = new Context();
        }
        return $this->context;
    }

    public function getType()
    {
        if(!$this->type)
            throw new \RuntimeException('Type is not initialized to test');
        return $this->type;
    }

    protected function getStrategy()
    {
        if(!$this->strategy)
            throw new \RuntimeException('Strategy is not initialized to test');
        return $this->strategy;
    }

    protected function getNormalizedData()
    {
        return $this->normalizedData;
    }

    protected function getDenormalizedData()
    {
        return $this->denormalizedData;
    }
}

