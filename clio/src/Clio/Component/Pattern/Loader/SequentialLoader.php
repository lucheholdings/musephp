<?php
namespace Clio\Component\Pattern\Loader;

/**
 * SequentialLoader 
 * 
 * @uses Loader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SequentialLoader implements Loader
{
    /**
     * loaders 
     * 
     * @var mixed
     * @access private
     */
    private $loaders;

    /**
     * __construct 
     * 
     * @param array $loaders 
     * @access public
     * @return void
     */
    public function __construct(array $loaders = array())
    {
        $this->loaders = array();

        foreach($loaders as $loader) {
            $this->add($loader);
        }
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
        $loaded = array();

        foreach($this->loaders as $loader) {
            if($loader->canLoad($resource, $options)) {
                $loaded[] = $loader->load($resource, $options);
            }
        }

        return $loaded;
    }

    /**
     * canLoad 
     * 
     * @param mixed $resource 
     * @param array $options 
     * @access public
     * @return void
     */
    public function canLoad($resource, array $options = array())
    {
        foreach($this->loaders as $loader) {
            if($loader->canLoad($resource, $options)) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * add 
     * 
     * @param Loader $loader 
     * @access public
     * @return void
     */
    public function add(Loader $loader)
    {
        $this->loaders[] = $loader;
        return $this;
    }
}

