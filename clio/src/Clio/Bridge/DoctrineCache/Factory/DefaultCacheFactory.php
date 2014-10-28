<?php
namespace Clio\Bridge\DoctrineCache\Factory;

use Clio\Component\Pattern\Factory\MappedComponentFactory;
use Clio\Component\Exception\UnsupportedException;

class DefaultCacheFactory extends MappedComponentFactory 
{
	/**
	 * {@inheritdoc}
	 */
	protected function initFactory()
	{
		$this->setMappedClass('phpfile', 'Doctrine\Common\Cache\PhpFileCache');
		$this->setMappedClass('filesystem', 'Doctrine\Common\Cache\FilesystemCache');
		$this->setMappedClass('memcache', 'Doctrine\Common\Cache\MemcacheCache');
		$this->setMappedClass('memcached', 'Doctrine\Common\Cache\MemcachedCache');
	}

	/**
	 * {@inheritdoc}
	 */
	public function createByKeyArgs($key, array $args = array())
	{
		switch($key) {
		case 'phpfile':
		case 'filesystem':
			$cache = parent::createByKeyArgs($key, $args);
			break;
		case 'memcache':
			$cache = parent::createByKeyArgs($key);
			$cache->setMemcache(array_shift($args));
			break;
		case 'memcached':
			$cache = parent::createByKeyArgs($key);
			$cache->setMemcache(array_shift($args));
			break;
		default:
			throw new UnsupportedException(sprintf('Cache type "%s" is not supported type.', $key));
		}

		return $cache;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedKeyArgs($key, array $args = array())
	{
		switch($key) {
		case 'phpfile':
		case 'filesystem':
		case 'memcache':
		case 'memcached':
			return true;
		default:
			return false;
		}
	}

	protected function resolveKeyArgs($key, array $args = array())
	{
		$options = array_shift($args);
		switch($key) {
		case 'phpfile':
		case 'filesystem':
			return array($options['directory'], isset($options['extension']) ? $options['extension'] : null);
		default:
			return array();
		}
	}
}

