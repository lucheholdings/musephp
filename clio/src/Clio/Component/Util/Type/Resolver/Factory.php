<?php
namespace Clio\Component\Util\Type\Resolver;

use Clio\Component\Util\Type\Registry as TypeRegistry;
use Clio\Component\Util\Type\Factory as TypeFactory;

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
     * createWithRegistry 
     * 
     * @param TypeRegistry $typeRegistry 
     * @static
     * @access public
     * @return void
     */
    static public function createWithRegistry(TypeRegistry $typeRegistry)
    {
        $actualTypeResolver = new RegisteredTypeResolver($typeRegistry);

        return new TypeChainResolver(array(
                new ProxyTypeResolver(),
                new MixedTypeResolver(),
                $actualTypeResolver
            ));
    }

    /**
     * createWithFactory 
     *    
     * @param TypeFactory $typeFactory 
     * @static
     * @access public
     * @return void
     */
    static public function createWithFactory(TypeFactory $typeFactory)
    {
        $actualTypeResolver = new TypeFactoryResolver($typeFactory);

        return new TypeChainResolver(array(
                new ProxyTypeResolver($actualTypeResolver),
                new MixedTypeResolver($actualTypeResolver),
                $actualTypeResolver
            ));
    }
}

