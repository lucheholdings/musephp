<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Adapter\SymfonyBundles\FrameworkBundle\Container\Map\Factory;

/**
 * MemcachedMapFactory 
 * 
 * @uses ServiceStorageMapFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MemcachedMapFactory extends ServiceStorageMapFactory
{
	protected function resolveArgs(array $args = array())
	{
		// arugment 0 : Memcached 
		if(isset($args[0])) {
			$args[0] = $this->getContainer()->get($args[0]);
		}

		return $args;
	}

	protected function getStorageClass()
	{
		return '\Clio\Component\Util\Container\Storage\Memcached\MemcachedStorage';
	}
}

