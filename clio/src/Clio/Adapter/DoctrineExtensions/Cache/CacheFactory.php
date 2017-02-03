<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Adapter\DoctrineExtensions\Cache;

use Clio\Component\Pattern\Factory\InheritComponentFactory;

class CacheFactory extends InheritComponentFactory
{
	public function __construct()
	{
		parent::__construct('Doctrine\Common\Cache\Cache');
	}

	protected function doCreate(array $args = array())
	{
		$class = new \ReflectionClass($this->detectCacheClass($args));

		// 
		$args = $this->resolveArgsForStorage($args);
	
		return $this->createInheritClassArgs($class, $args);
	}

	protected function detectCacheClass(array $args)
	{
		$storage = reset($args);

		if(is_object($storage)) {
			if((class_exists('\Memcached')) && ($storage instanceof \Memcached)) {
				return '\Doctrine\Common\Cache\MemcachedCache';
			} else if((class_exists('\Memcache')) && ($storage instanceof \Memcache)) {
				return '\Doctrine\Common\Cache\MemcacheCache';
			} else if((class_exists('\MongoCollection')) && ($storage instanceof \MongoCollection)) {
				return '\Doctrine\Common\Cache\MongoCollection';
			}
		} else if(is_string($storage)) {
			switch($storage) {
			case 'array':
				return '\Doctrine\Common\Cache\ArrayCache';
				break;
			case 'php':
				return '\Doctrine\Common\Cache\PhpFileCache';
				break;
			case 'file':
				return '\Doctrine\Common\Cache\FileCache';
				break;
			case 'file_system':
				return '\Doctrine\Common\Cache\FilesstemCache';
				break;
			}
		}

		throw new \RuntimeException('Failed to solve the type of DoctrineCache.');
	}

	protected function resolveArgsForStorage(\ReflectionClass $class, array $args)
	{
		if( $class->isInstanceof('\Doctrine\Common\Cache\FileCache') ||
			$class->isInstanceof('\Doctrine\Common\Cache\ArrayCache')) {
			
			// replace the type argument
			array_shift($args);
		}

		return $args;
	}
}

