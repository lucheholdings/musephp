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
 * AliasServiceRegistry
 *   is a ProxyRegistry which map id with alias
 * @package ${ PACKAGE }
 * @subpackage 
 * @author ${ AUTHOR }
 */
class AliasServiceRegistry implements ServiceRegistryInterface 
{
	private $registry;

	private $aliases;

	public function __construct(ServiceRegistryInterface $registry)
	{
		$this->registry = $registry;
	}

	public function has($id)
	{
		return isset($this->aliases[$id]) && $this->getRegistry()->has($this->alises[$id]);
	}

	public function get($id)
	{
		if(!isset($this->aliases[$id])) {
			throw new \InvalidArgumentException(sprintf('Alias "%s" is not registered', $id));
		}
		$alias = $this->aliases[$id];

		$service = $this->getRegistry()->get($alias);

		if(!$this->isValidService($service)) {
			throw new \RuntimeException(sprintf('Invalid serivce "%s" is registered.', get_class($service)));
		}

		return $service;
	}

	public function set($id, $service)
	{
		throw new \RuntimeException('AliasServiceRegistry cannot set Service. Please use setAlias and getRegistry::set() to set actual service.');
	}

	public function hasAlias($id)
	{
		return isset($this->aliases[$id]);
	}

	public function getAlias($id)
	{
		return $this->aliases[$id];
	}

	public function setAlias($id, $aliased)
	{
		$this->aliases[$id] = $aliased;
		return $this;
	}

	public function removeAlias($id)
	{
		unset($this->aliases[$id]);

		return $this;
	}

	protected function isValidService($service)
	{
		return is_object($service);
	}
    
    public function getRegistry()
    {
        return $this->registry;
    }
    
    public function setRegistry($registry)
    {
        $this->registry = $registry;
        return $this;
    }
    
    public function getAliases()
    {
        return $this->aliases;
    }
    
    public function setAliases($aliases)
    {
        $this->aliases = $aliases;
        return $this;
    }
}

