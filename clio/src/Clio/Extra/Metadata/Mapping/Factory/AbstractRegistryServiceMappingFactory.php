<?php
namespace Clio\Extra\Metadata\Mapping\Factory;

use Clio\Component\Util\Metadata\Mapping\Factory\AbstractFactory;

use Clio\Component\Pattern\Registry\Registry;
use Clio\Component\Util\Injection\InjectorCollection;
use Clio\Component\Util\Injection\SubclassInjector;

abstract class AbstractRegistryServiceMappingFactory extends AbstractFactory 
{
	private $registry;

	private $serviceIds;

	protected $injector;

	public function __construct(Registry $registry, array $serviceIds = array())
	{
		$this->registry = $registry;
		$this->serviceIds = $serviceIds;
	}

	public function getInjector()
	{
		if(!$this->injector) {
			// 
			$this->injector = new InjectorCollection(array(
				new SubclassInjector('Clio\Extra\Metadata\Mapping\AbstractRegistryServiceMapping', 'setRegistry', array($this->getRegistry())),
			));
		}
		return $this->injector;
	}
    
    public function getRegistry()
    {
        return $this->registry;
    }
    
    public function setRegistry(Registry $registry)
    {
        $this->registry = $registry;
        return $this;
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

	public function getServiceId($name)
	{
		return $this->serviceIds[$name];
	}
}
