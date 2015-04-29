<?php
namespace Clio\Component\Type\Resolver;

/**
 * Factory 
 *   Factory to create Resolver for common usage.
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Factory 
{
    /**
     * createWithFactories 
     *    
     * @param TypeFactory $typeFactory 
     * @static
     * @access public
     * @return void
     */
    static public function createWithFactories($factories)
    {
        $resolvers = array();
        foreach($factories as $factory) {
            $resolvers[] = new TypeFactoryResolver($factory);
        }

        return new TypeChainResolver($resolvers);
    }
}

