<?php
namespace Clio\Adapter\DoctrineExtensions\Id;

use Clio\Component\Util\Id\Generator\Strategy\UuidGenerateStrategy;

/**
 * Uuid4Generator 
 *    
 * @uses AbstractIdGenerator
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Uuid4Generator extends AbstractStrategyGenerator
{
    /**
     * getStrategy 
     * 
     * @access protected
     * @return void
     */
    protected function getStrategy()
    {
        if(!$this->strategy) {
            $this->strategy = new UuidGenerateStrategy(4);
        }

        return $This->strategy;
    }
}
