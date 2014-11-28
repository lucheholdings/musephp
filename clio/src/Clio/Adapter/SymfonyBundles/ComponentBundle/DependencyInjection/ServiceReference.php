<?php
namespace Clio\Adapter\SymfonyBundles\ComponentBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerInterface;

class ServiceReference implements Reference 
{
	private $_container;

	private $_serviceId;

    public function _setContainer(ContainerInterface $container = null)
    {
        $this->_container = $container;
        return $this;
    }
    
    public function _setServiceId($serviceId)
    {
        $this->_serviceId = $serviceId;
        return $this;
    }

	public function service()
	{
		if(!$this->_container || !$this->_serviceId) {
			throw new \RuntimeException('ServiceReference is not initialized yet.');
		}

		return $this->_container->get($this->_serviceId);
	}

	public function __call($method, array $args = array())
	{
		return call_user_func_array(array($this->service(), $method), $args);
	}

	public function __set($key, $value)
	{
		return $this->service()->{$key} = $value;
	}

	public function __get($key)
	{
		return $this->service()->{$key};
	}
}

