<?php
namespace Erato\Adapter\SymfonyBundles\FrameworkBundle\Schema\Mapping\Factory;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Util\Metadata\Mapping;
use Clio\Component\Util\Metadata\Mapping\NamedFactory;
use Erato\Adapter\SymfonyBundles\FrameworkBundle\Schema\Mapping\Proxy;

/**
 * Collection 
 * 
 * @uses NamedFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Collection implements NamedFactory
{
    /**
     * container 
     * 
     * @var mixed
     * @access private
     */
    private $container;

    /**
     * factoryIds 
     * 
     * @var array
     * @access private
     */
    private $factoryIds = array();

    /**
     * __construct 
     * 
     * @param ContainerInterface $container 
     * @param array $factoryIds 
     * @access public
     * @return void
     */
    public function __construct(ContainerInterface $container, array $factoryIds = array())
    {
        $this->container = $container;
        $this->factoryIds = $factoryIds;
    }

    /**
     * createMappingFor 
     * 
     * @param mixed $name 
     * @param Metadata $metadata 
     * @param array $options 
     * @access public
     * @return void
     */
    public function createMappingFor($name, Metadata $metadata, array $options = array())
    {
        return new Proxy($this->getContainer(), $this->getFactoryIdFor($name), $metadata, $name, $options);
    }

    public function createMappings(Metadata $metadata, array $options = array())
    {
        $mappings = array();
        foreach($this->getFactoryIds() as $name => $id) {
            $mappings[$name] = new Proxy($this->getContainer(), $id, $metadata, $name, isset($options[$name]) ? $options[$name] : array());
        }

        return new Mapping\Collection($mappings);
    }

    /**
     * getContainer 
     * 
     * @access public
     * @return void
     */
    public function getContainer()
    {
        return $this->container;
    }
    
    /**
     * setContainer 
     * 
     * @param ContainerInterface $container 
     * @access public
     * @return void
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
        return $this;
    }
    
    /**
     * getFactoryIds 
     * 
     * @access public
     * @return void
     */
    public function getFactoryIds()
    {
        return $this->factoryIds;
    }
    
    /**
     * setFactoryIds 
     * 
     * @param array $factoryIds 
     * @access public
     * @return void
     */
    public function setFactoryIds(array $factoryIds)
    {
        $this->factoryIds = $factoryIds;
        return $this;
    }

    /**
     * getFactoryIdFor 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
    public function getFactoryIdFor($name)
    {
        if(!isset($this->factoryIds[$name])) {
            throw new \InvalidArgumentException(sprintf('MappingFactory for "%s" is not exists.', $name));
        }
        return $this->factoryIds[$name];
    }

    /**
     * addFactoryIdFor 
     * 
     * @param mixed $name 
     * @param mixed $factoryId 
     * @access public
     * @return void
     */
    public function addFactoryIdFor($name, $factoryId)
    {
        $this->factoryIds[$name] = $factoryId;
        return $this;
    }

    /**
     * getFactory 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
    public function getFactory($name)
    {
        return $this->getContainer()->get($this->getFactoryIdFor($name));
    }

    public function getFactories()
    {
        $factories = array();
        foreach($this->factoryIds as $name => $factoryId) {
            $factories[$name] = $this->getContainer()->get($factoryId);
        }
        return $factories;
    }
}

