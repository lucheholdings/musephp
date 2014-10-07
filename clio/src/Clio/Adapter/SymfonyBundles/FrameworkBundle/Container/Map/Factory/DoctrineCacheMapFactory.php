<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Adapter\SymfonyBundles\FrameworkBundle\Container\Map\Factory;

use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * DoctrineCacheMapFactory
 * 
 * @uses ComponentFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DoctrineCacheMapFactory extends ServiceStorageMapFactory
{
	protected function resolveArgs(array $args = array())
	{
		// arugment 0 : DoctrineCache 
		if(isset($args[0])) {
			$args[0] = $this->getContainer()->get($args[0]);
		}

		return $args;
	}

	protected function getStorageClass()
	{
		return 'Clio\Bridge\DoctrineCache\Container\DoctrineCacheStorage';
	}
}

