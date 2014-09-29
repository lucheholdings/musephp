<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Framework\Registry;

/**
 * ProxyServiceRegistry
 *   is a ProxyRegistry which map id with alias
 * @package ${ PACKAGE }
 * @subpackage 
 * @author ${ AUTHOR }
 */
class ProxyServiceRegistry implements ServiceRegistryInterface 
{
	private $registry;

	public function __construct(ServiceRegistryInterface $registry)
	{
		$this->registry = $registry;
	}

	public function has($id)
	{
		return $this->getRegistry()->has($id);
	}

	public function get($id)
	{
		$service = $this->getRegistry()->get($id);
		return $service;
	}

	public function set($id, $service)
	{
		$this->getRegistry()->set($id, $service);

		return $this;
	}

    public function getRegistry()
    {
        return $this->registry;
    }
    
    public function setRegistry(ServiceRegistryInterface $registry)
    {
        $this->registry = $registry;
        return $this;
    }
}

