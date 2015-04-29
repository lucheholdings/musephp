<?php
namespace Clio\Component\Type\Resolver;

use Clio\Component\Type\Resolver;

/**
 * TypeResolverChain 
 * 
 * @uses Resolver
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class TypeResolverChain implements Resolver
{
    /**
     * rootResolver 
     * 
     * @var mixed
     * @access private
     */
    private $rootResolver;

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
        $type = $this->doResolve($type, $options);

        return $type;
    }

    /**
     * doResolve 
     * 
     * @param mixed $type 
     * @param array $options 
     * @abstract
     * @access protected
     * @return void
     */
    abstract protected function doResolve($type, array $options);
    
    /**
     * getRootResolver 
     * 
     * @access public
     * @return void
     */
    public function getRootResolver()
    {
        return $this->rootResolver;
    }
    
    /**
     * setRootResolver 
     * 
     * @param Resolver $rootResolver 
     * @access public
     * @return void
     */
    public function setRootResolver(Resolver $rootResolver)
    {
        $this->rootResolver = $rootResolver;
        return $this;
    }
}

