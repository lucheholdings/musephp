<?php
namespace Clio\Component\Type\Resolver;

use Clio\Component\Type\Resolver;

/**
 * TypeResolverProxyChain 
 * 
 * @uses TypeResolverChain
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class TypeResolverProxyChain extends TypeResolverChain 
{
    /**
     * __construct 
     * 
     * @param Resolver $baseResolver 
     * @access public
     * @return void
     */
    public function __construct(Resolver $baseResolver)
    {
        $this->baseResolver = $baseResolver;
    }

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
        return $this->baseResolver->canResolve($type, $options);
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
        return $this->baseResolver->resolve($type, $options);
    }
}

