<?php
namespace Clio\Extra\Metadata\Mapping;

use Clio\Component\Util\Metadata\Mapping\AbstractMapping;
use Clio\Component\Util\Metadata\Metadata;
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

	private $serviceIds;

	public function __construct(Metadata $metadata, Registry $registry = null, array $serviceIds = array(), array $options = array())
	{
		parent::__construct($metadata, $options);
		$this->_registry = $registry;
		$this->serviceIds = $serviceIds;
	}
    
    public function getServiceIds()
    {
        return $this->serviceIds;
    }
    
    public function setServiceIds(array $serviceIds)
    {
        $this->serviceIds = $serviceIds;
        return $this;
    }

	public function setServiceId($name, $id)
	{
		$this->serviceIds[$name] = $id;
	}

	public function getServiceId($name)
	{
		if(!isset($this->serviceIds[$name])) {
			throw new \RuntimeException(sprintf('Service for "%s" is not specified.', $name));
		}
		return $this->serviceIds[$name];
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

	/**
	 * {@inheritdoc}
	 * 
	 * Serialize with the serviceId only.
	 * Registry will be injected by the warmer
	 */
	public function serialize(array $extra = array())
	{
		$extra['service_ids'] = $this->serviceIds;
		return parent::serialize($extra);
	}

	/**
	 * {@inheritdoc}
	 */
	public function unserialize($serialized)
	{
		$extra = parent::unserialize($serialized);
		
		$this->serviceIds = $extra['service_ids'];
		unset($extra['service_ids']);

		return $extra;
	}

	public function dumpConfig()
	{
		return array(
			'services'   => $this->serviceIds,
			'options'    => $this->getOptions(),
		);
	}
}

