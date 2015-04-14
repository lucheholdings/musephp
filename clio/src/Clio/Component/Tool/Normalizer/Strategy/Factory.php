<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

/**
 * Factory 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class Factory
{
    static public function createDefaultSet()
    {
        return new PriorityCollection(array(
                // Special Type Strategy
                new MixedStrategy(),
                new ReferenceStrategy(),
                // Primitive type strategies
                new NullStrategy(),
                new ScalarStrategy(),
                new ArrayStrategy(),
                // Class Strategies
                new DateTimeStrategy(),
                // Custom Strategies below
            ));
    }

    static public function createMinimumSet()
    {
        return new PriorityCollection(array(
                // Special Type Strategy
                new MixedStrategy(),
                new ReferenceStrategy(),
                // Primitive type strategies
                new NullStrategy(),
                new ScalarStrategy(),
                new ArrayStrategy(),
            ));
    }
}

