<?php
namespace Clio\Component\Util\Metadata\Loader;

use Clio\Component\Pattern\Loader\Loader;
use Clio\Component\Pattern\Loader\ProxyLoader;
/**
 * WarmupLoader 
 *    Warmup Metadata and Mappings.
 *    Commonly named as CompilerLoader or some.
 * 
 * @uses ProxyLoader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class WarmupLoader extends ProxyLoader 
{
    /**
     * warmer 
     * 
     * @var mixed
     * @access private
     */
    private $warmer;
    
    /**
     * _loadings 
     * 
     * @var mixed
     * @access private
     */
    private $_loadings;

    /**
     * __construct 
     * 
     * @param Loader $loader 
     * @param Warmer $warmer 
     * @access public
     * @return void
     */
    public function __construct(Loader $loader, Warmer $warmer)
    {
        $this->warmer = $warmer;
        parent::__construct($loader);
    }

    /**
     * load 
     * 
     * @param mixed $type 
     * @access public
     * @return void
     */
    public function load($type)
    {
        // 1st. load from proxied loader
        $loaded = parent::load($type);

        // 2nd. Warm the loaded object
        $this->warmer->warm($loaded, $type);

        return $loaded;
    }
    
    /**
     * getWarmer 
     * 
     * @access public
     * @return void
     */
    public function getWarmer()
    {
        return $this->warmer;
    }
    
    /**
     * setWarmer 
     * 
     * @param Warmer $warmer 
     * @access public
     * @return void
     */
    public function setWarmer(Warmer $warmer)
    {
        $this->warmer = $warmer;
        return $this;
    }
}

