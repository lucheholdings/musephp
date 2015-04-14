<?php
namespace Clio\Component\Tool\Normalizer\Tests\Strategy;

use Clio\Component\Tool\Normalizer\Tests\StrategyTestCase;
use Clio\Component\Tool\Normalizer\Strategy\ScalarStrategy;

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

