<?php
namespace Clio\Extra\Normalizer\Strategy;

use Clio\Component\Normalizer\Strategy;
use Clio\Component\Accessor\Registry as RegistryInterface;

/**
 * Factory 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class Factory extends Strategy\Factory
{
    /**
     * createDefaultSet 
     * 
     * @param RegistryInterface $accessorRegsitry 
     * @static
     * @access public
     * @return void
     */
    static public function createDefaultSet(RegistryInterface $accessorRegistry = null) 
    {
        if($accessorRegistry) {
            return new Strategy\PriorityCollection(array(
                    // 
		    	    new Strategy\MixedStrategy(),
		    	    new Strategy\ReferenceStrategy(),
                    // 
                    new Strategy\NullStrategy(),
                    // Custom Strategy

                    // Accessor Strategy
		    	    new AccessorStrategy($accessorRegistry),
                ));
        } else {
            return parent::createDefaultSet();
        }
    }
}

