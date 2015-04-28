<?php
namespace Clio\Component\Pattern\Loader;

use Clio\Component\Pattern\Loader\Exception as LoaderException;

/**
 * SequentialLoader 
 * 
 * @uses Loader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SequentialLoader implements Loader, \IteratorAggregate
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
            try {
                $loaded[] = $loader->load($resource, $options);
            } catch (LoaderException $exception) {
                continue;
            }
        }

        return $loaded;
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

    public function getIterator()
    {
        return new \ArrayIterator($this->loaders);
    }
    
    public function getLoaders()
    {
        return $this->loaders;
    }
    
    public function setLoaders(array $loaders)
    {
        $this->loaders = array();
        foreach($loaders as $loader) {
            $this->add($loader);
        }
        return $this;
    }
}

