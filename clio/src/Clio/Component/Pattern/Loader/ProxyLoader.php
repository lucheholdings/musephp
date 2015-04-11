<?php
namespace Clio\Component\Pattern\Loader;

/**
 * ProxyLoader 
 *    Simple ProxyLoader.
 *    In case to implemente CacheLoader, WarmLoader and some extends this.
 * @uses Loader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ProxyLoader implements Loader 
{
    /**
     * loader 
     * 
     * @var mixed
     * @access private
     */
    private $loader;

    /**
     * __construct 
     * 
     * @param Loader $loader 
     * @access public
     * @return void
     */
    public function __construct(Loader $loader)
    {
        $this->loader = $loader;
    }

    /**
     * load 
     * 
     * @param mixed $resource 
     * @param array $options 
     * @access public
     * @return void
     */
    public function load($resource, array $options = array())
    {
        $this->getLoader()->load($resource, $options);
    }
    
    /**
     * getLoader 
     * 
     * @access public
     * @return void
     */
    public function getLoader()
    {
        return $this->loader;
    }
    
    /**
     * setLoader 
     * 
     * @param Loader $loader 
     * @access public
     * @return void
     */
    public function setLoader(Loader $loader)
    {
        $this->loader = $loader;
        return $this;
    }
}

