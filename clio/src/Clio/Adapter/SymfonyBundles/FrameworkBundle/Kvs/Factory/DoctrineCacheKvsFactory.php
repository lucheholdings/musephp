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

use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * DoctrineCacheKvsFactory
 * 
 * @uses ComponentFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DoctrineCacheKvsFactory extends AbstractKvsFactory
{
	private $container;

	public function __construct(ContainerInterface $container)
	{
		parent::__construct();
		
		$this->container = $container;
	}

	protected function resolveArguments(array $args = array())
	{
		// arugment 0 : DoctrineCache 
		if(isset($args[0])) {
			$args[0] = $this->container->get($args[0]);
		}

		return $args;
	}

	protected function getStorageClass()
	{
		return 'Clio\Bridge\DoctrineCache\Container\DoctrineCacheStorage';
	}
}

