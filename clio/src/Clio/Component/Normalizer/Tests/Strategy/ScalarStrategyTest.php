<?php
namespace Clio\Component\Normalizer\Tests\Strategy;

use Clio\Component\Normalizer\Tests\StrategyTestCase;
use Clio\Component\Normalizer\Strategy\ScalarStrategy;

class ScalarStrategyTest extends StrategyTestCase 
{
    public function testBasic()
    {
        $this->strategy = new ScalarStrategy();
        $this->type     = $this->getContext()->getTypeResolver()->resolve('string');
        $this->normalizedData   = 'foo';
        $this->denormalizedData = 'foo';

        $this->doTestNormalize();
        $this->doTestDenormalize();
    }
}

