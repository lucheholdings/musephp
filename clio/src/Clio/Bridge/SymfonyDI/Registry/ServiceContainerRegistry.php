<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Bridge\SymfonyDI\Registry;

use Clio\Framework\Registry\ServiceRegistryInterface;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * ServiceContainerRegistry
 * 
 * @package ${ PACKAGE }
 * @subpackage 
 * @author ${ AUTHOR }
 */
class ServiceContainerRegistry implements ServiceRegistryInterface 
{
	/**
	 * container 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $container;

	/**
	 * __construct 
	 * 
	 * @param ContainerInterface $container 
	 * @access public
	 * @return void
	 */
	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	/**
	 * has 
	 * 
	 * @param mixed $id 
	 * @access public
	 * @return void
	 */
	public function has($id)
	{
		return $this->container->has($id);
	}

	/**
	 * get 
	 * 
	 * @param mixed $id 
	 * @access public
	 * @return void
	 */
	public function get($id)
	{
		return $this->container->get($id);
	}

	/**
	 * set 
	 * 
	 * @param mixed $id 
	 * @param mixed $service 
	 * @access public
	 * @return void
	 */
	public function set($id, $service)
	{
		$this->container->set($id, $service);
		return $this;
	}

	public function count()
	{
		return $this->container->count();
	}

	public function remove($id)
	{
		$this->container->remove($id);
		return $this;
	}

	public function clear()
	{
		$this->container->clear();
	}
}

