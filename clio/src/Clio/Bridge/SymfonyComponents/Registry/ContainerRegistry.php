<?php
namespace Clio\Bridge\SymfonyComponents\Registry;

use Clio\Component\Pattern\Registry\Registry;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * ContainerRegistry 
 * 
 * @uses Registry
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ContainerRegistry implements Registry
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
	 * {@inheritdoc}
	 */
	public function has($id)
	{
		return $this->container->has($id);
	}

	/**
	 * {@inheritdoc}
	 */
	public function get($id)
	{
		return $this->container->get($id);
	}

	/**
	 * {@inheritdoc}
	 */
	public function set($id, $service)
	{
		$this->container->set($id, $service);
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function count()
	{
		return $this->container->count();
	}

	/**
	 * {@inheritdoc}
	 */
	public function remove($id)
	{
		throw new UnsupportedException('ContainerRegistry does not support remove.');
	}

	/**
	 * {@inheritdoc}
	 */
	public function clear()
	{
		// 
		throw new UnsupportedException('ContainerRegistry does not support clear.');
	}
}

