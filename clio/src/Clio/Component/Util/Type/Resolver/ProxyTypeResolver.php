<?php
namespace Clio\Component\Util\Type\Resolver;

use Clio\Component\Util\Type\ProxyType;

/**
 * ProxyTypeResolver 
 * 
 * @uses TypeResolverChain
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ProxyTypeResolver extends TypeResolverChain 
{
    /**
     * canResolve 
     * 
     * @param mixed $type 
     * @param array $options 
     * @access public
     * @return void
     */
    public function canResolve($type, array $options = array())
    {
        return $type instanceof ProxyType;
    }

    /**
     * doResolve 
     * 
     * @param mixed $type 
     * @param array $options 
     * @access protected
     * @return void
     */
    protected function doResolve($type, array $options)
    {
        return $this->getRootResolver()->resolve($type->getType(), $options);
    }

}

