<?php
namespace Clio\Extra\Metadata\Mapping;

use Clio\Component\Metadata\Mapping\AbstractMapping;
use Clio\Component\Metadata\Metadata;
use Clio\Component\Pattern\Registry\Registry;
/**
 * AbstractRegistryServiceMapping 
 *   AbstractRegistryServiceMapping is a Mapper class to map relative 
 *   object to the metadata.
 *   In case if there are some normalizer instances, and to  
 *   switch the normalizer by metadata, this ServiceMapping class
 *   is useful.
 *   ServiceMapping will resolve the service with that id and registry.
 * 
 * Be care:
 *   For this class's factory has to provide injector to inject Registry
 *   for CacheWarmer 
 * 
 * @uses AbstractMapping
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractRegistryServiceMapping extends AbstractMapping
{
	private $_registry;

	public function __construct(Metadata $metadata, Registry $registry = null, array $serviceIds = array(), array $options = array())
	{
		$options['services'] = $serviceIds;
		parent::__construct($metadata, $options);
		$this->_registry = $registry;
	}
    
    public function getServiceIds()
    {
        return $this->getOption('services');
    }
    
    public function setServiceIds(array $serviceIds)
    {
        $this->setOption('services', $serviceIds);
        return $this;
    }

	public function setServiceId($name, $id)
	{
		$services = $this->getOption('services');
		$services[$name] = $id;
		$this->setOptions('services', $services);
	}

	public function getServiceId($name)
	{
		$services = $this->getOption('services');
		if(!isset($services[$name])) {
			throw new \RuntimeException(sprintf('Service for "%s" is not specified.', $name));
		}
		return $services[$name];
	}

	public function getService($name)
	{
		return $this->getRegistry()->get($this->getServiceId($name));
	}

    public function getRegistry()
    {
		if(!$this->_registry) {
			throw new \RuntimeException(sprintf('Mapping "%s" is not initialized yet.', $this->getName()));
		}
        return $this->_registry;
    }
    
    public function setRegistry(Registry $registry)
    {
        $this->_registry = $registry;
        return $this;
    }

	public function dumpConfig()
	{
		return array(
			'options'    => $this->getOptions(),
		);
	}
}

