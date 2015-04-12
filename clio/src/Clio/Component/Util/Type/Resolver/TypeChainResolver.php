<?php
namespace Clio\Component\Util\Type\Resolver;

use Clio\Component\Util\Type\Resolver;

/**
 * TypeChainResolver 
 * 
 * @uses Resolver
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class TypeChainResolver implements Resolver 
{
    /**
     * chains 
     * 
     * @var array
     * @access private
     */
    private $chains = array();

    /**
     * __construct 
     * 
     * @param array $chains 
     * @access public
     * @return void
     */
    public function __construct(array $chains = array())
    {
        $this->chains = array();
        foreach($chains as $chain) {
            $this->append($chain);
        }
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
        foreach($this->chains as $next) {
            if($next->canResolve($type, $options))
                return true;
        }
        return false;
    }

    /**
     * resolve 
     * 
     * @param mixed $type 
     * @param array $options 
     * @access public
     * @return void
     */
    public function resolve($type, array $options = array())
    {
        foreach($this->chains as $next) {
            if($next->canResolve($type, $options)) {
                $type = $next->resolve($type, $options);
            }
        }
        return $type;
    }

    /**
     * prepend 
     * 
     * @param Resolver $resolver 
     * @access public
     * @return void
     */
    public function prepend(Resolver $resolver)
    {
        if(!$resolver instanceof TypeResolverChain) 
            $resolver = new TypeResolverProxyChain($resolver);

        $resolver->setRootResolver($this);
        array_unshift($this->chains, $resolver);
    }

    /**
     * append 
     * 
     * @param Resolver $resolver 
     * @access public
     * @return void
     */
    public function append(Resolver $resolver)
    {
        if(!$resolver instanceof TypeResolverChain) 
            $resolver = new TypeResolverProxyChain($resolver);

        $resolver->setRootResolver($this);
        array_push($this->chains, $resolver);
    }
}
