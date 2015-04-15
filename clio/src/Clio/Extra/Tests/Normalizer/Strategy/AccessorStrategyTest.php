<?php
namespace Clio\Extra\Tests\Normalizer;

use Clio\Component\Tool\Normalizer\Tests\StrategyTestCase;
use Clio\Extra\Normalizer\Strategy\AccessorStrategy;

use Clio\Extra\Tests\TestAccessorRegistry;
use Clio\Extra\Tests\TestTypeRegistry;
use Clio\Extra\Tests\Models;

use Clio\Component\Tool\Normalizer\Context;
use Clio\Component\Tool\Normalizer\Type\TypeResolver as NormalizerTypeResolver;
use Clio\Component\Util\Type as Types;

class AccessorStrategyTest extends StrategyTestCase 
{
    private $context;

    public function testPrimitives()
    {
        $this->strategy = new AccessorStrategy(new TestAccessorRegistry());
        // test string
        $this->type     = $this->getContext()->getTypeResolver()->resolve('string');
        $this->normalizedData   = 'foo';
        $this->denormalizedData = 'foo';

        $this->doTestNormalize();
        $this->doTestDenormalize();

        // test int
        $this->type     = $this->getContext()->getTypeResolver()->resolve('int');
        $this->normalizedData   = 100;
        $this->denormalizedData = 100;

        $this->doTestNormalize();
        $this->doTestDenormalize();

        // test int
        $this->type     = $this->getContext()->getTypeResolver()->resolve('int');
        $this->normalizedData   = 100;
        $this->denormalizedData = 100;

        $this->doTestNormalize();
        $this->doTestDenormalize();
    }

    public function testObject()
    {
        $this->strategy = new AccessorStrategy(new TestAccessorRegistry());
        // test object
        $this->type     = $this->getContext()->getTypeResolver()->resolve('Clio\Extra\Tests\Models\NormalizerTestModel');

        $this->normalizedData   = array('foo' => 'Foo', 'bar' => 'Bar');
        $this->denormalizedData = new Models\NormalizerTestModel();

        $this->doTestNormalize();
        $this->doTestDenormalize();
    }

    public function getContext()
    {
        if(!$this->context) {
            $this->context = new Context(new NormalizerTypeResolver(Types\Resolver\Factory::createWithRegistry(new TestTypeRegistry())));
        }
        return $this->context;
    }
}

