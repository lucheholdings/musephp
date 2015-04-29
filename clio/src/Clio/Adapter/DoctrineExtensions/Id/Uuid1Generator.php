<?php
namespace Clio\Adapter\DoctrineExtensions\Id;

use Clio\Component\Id\Generator\Strategy\UuidGenerateStrategy;

/**
 * Uuid1Generator 
 *    
 * @uses AbstractIdGenerator
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Uuid1Generator extends AbstractStrategyGenerator
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
            $this->strategy = new UuidGenerateStrategy(1);
        }

        return $this->strategy;
    }
}

