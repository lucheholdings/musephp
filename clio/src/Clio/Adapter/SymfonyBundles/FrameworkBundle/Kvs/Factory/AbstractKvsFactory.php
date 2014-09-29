<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Adapter\SymfonyBundles\FrameworkBundle\Kvs\Factory;

use Clio\Component\Pattern\Factory\ComponentFactory;

abstract class AbstractKvsFactory extends ComponentFactory
{
	private $storageFactory;

	public function __construct()
	{
		parent::__construct('Clio\Component\Util\Container\Map\StoragedMap');

		$this->storageFactory = new ComponentFactory($this->getStorageClass());
	}

	protected function doCreate(array $args)
	{
		$args = $this->resolveArguments($args);

		$storage = $this->doCreateStorage($args);

		return $this->getReflectionClass()->newInstanceArgs(array($storage));
	}

	protected function doCreateStorage($args)
	{
		return $this->storageFactory->createArgs($args);
	}

	abstract protected function getStorageClass();
    
    public function getContainer()
    {
        return $this->container;
    }
    
    public function setContainer($container)
    {
        $this->container = $container;
        return $this;
    }
}

