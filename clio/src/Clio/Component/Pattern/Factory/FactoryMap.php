<?php
namespace Clio\Component\Pattern\Factory;

/**
 * FactoryMap 
 * 
 * @uses AbstractMappedFactory
 * @uses MappedFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FactoryMap extends AbstractMappedFactory implements MappedFactory 
{
    /**
     * factories 
     * 
     * @var mixed
     * @access private
     */
    private $factories;

    /**
     * __construct 
     * 
     * @param array $factories 
     * @access public
     * @return void
     */
    public function __construct(array $factories = array())
    {
        $this->factories = array();
        foreach($factories as $key => $factory) {
            $this->addFactory($key, $factory);   
        }
    }

    /**
     * doCreateByKey 
     * 
     * @param mixed $key 
     * @param array $args 
     * @access protected
     * @return void
     */
    protected function doCreateByKey($key, array $args)
    {
        return $this->getFactory($key)->createArgs($args); 
    }
    
    /**
     * getFactories 
     * 
     * @access public
     * @return void
     */
    public function getFactories()
    {
        return $this->factories;
    }
    
    /**
     * setFactories 
     * 
     * @param mixed $factories 
     * @access public
     * @return void
     */
    public function setFactories($factories)
    {
        $this->factories = array();
        foreach($factories as $key => $factory) {
            $this->setFactory($key, $factory);   
        }
        return $this;
    }

    /**
     * setFactory 
     * 
     * @param mixed $key 
     * @param Factory $factory 
     * @access public
     * @return void
     */
    public function setFactory($key, Factory $factory)
    {
        $this->factories[$key]  = $factory;
    }

    /**
     * getFactory 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    public function getFactory($key)
    {
        if(!isset($this->factories[$key])) {
            throw new Exception\UnsupportedException(sprintf('Key "%s" is not supported.', (string)$key));
        }
        return $this->factories[$key];
    }

    /**
     * hasFactory 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    public function hasFactory($key)
    {
        return isset($this->factories[$key]);
    }
}

