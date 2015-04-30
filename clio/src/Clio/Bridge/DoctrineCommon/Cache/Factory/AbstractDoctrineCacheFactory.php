<?php
namespace Clio\Bridge\DoctrineCommon\Cache\Factory;

use Clio\Extra\Constructor\InjectionConstructor;
use Clio\Component\Pattern\Constructor\DefaultConstructorFactory;
use Clio\Component\Pattern\Factory;
use Clio\Component\Injection\MethodInjector;

/**
 * AbstractDoctrineCacheFactory 
 * 
 * @uses ComponentFactory
 * @uses MappedFactory
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractDoctrineCacheFactory extends Factory\MappedComponentFactory implements Factory\MappedFactory
{
	const ARG_KEY = 'type';

	static $doctrineCacheClasses = array(
		'apc'			=> 'Doctrine\Common\Cache\ApcCache',
		'array'			=> 'Doctrine\Common\Cache\ArrayCache',
		'file_system'	=> 'Doctrine\Common\Cache\FilesystemCache',
		'php_file'		=> 'Doctrine\Common\Cache\PhpFileCache',
		'couchbase'		=> 'Doctrine\Common\Cache\CouchbaseCache',
		'memcache'		=> 'Doctrine\Common\Cache\MemcacheCache',
		'memcached'		=> 'Doctrine\Common\Cache\MemcachedCache',
		'mongo_db'		=> 'Doctrine\Common\Cache\MongoDBCache',
		'redis'			=> 'Doctrine\Common\Cache\RedisCache',
		'riak'			=> 'Doctrine\Common\Cache\RiakCache',
	);

	public function __construct()
	{
		parent::__construct(self::$doctrineCacheClasses);
	}

	/**
	 * {@inheritdoc}
	 */
	public function createByKey($key)
	{
		return $this->doCreate(func_get_args());
	}

	/**
	 * {@inheritdoc}
	 */
	public function createByKeyArgs($key, array $args = array())
	{
		return $this->doCreateByKey($key, $args);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function doCreate(array $args)
	{
		return $this->doCreateByKey(Factory\Util::shiftArg($args, self::ARG_KEY), $args);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function doCreateByKey($key, array $args)
	{
		// Create DoctrineCache
		$doctrineCache = $this->createDoctrineCache($key, $args);
		
		return $this->createClassArgs($this->getCacheClass(), array($doctrineCache));
	}

	/**
	 * createDoctrineCache 
	 * 
	 * @param mixed $type 
	 * @param array $args 
	 * @access protected
	 * @return void
	 */
	protected function createDoctrineCache($type, array $args)
	{
		$class = $this->getMappedClass($type);

		$constructor = new InjectionConstructor(
			$this->getConstructorForDoctrineCacheType($type),
			$this->getInjectorForDoctrineCacheType($type, $args)
		);

		return $constructor->construct($class, $args); 
	}

	public function getConstructorForDoctrineCacheType($type)
	{
		$classReflector = $this->getMappedClass($type);
		return DefaultConstructorFactory::createConstructor($classReflector);
		switch($type) {
		case 'apc':
		case 'array':
		case 'couchbase':
		case 'memcache':
		case 'memcached':
		case 'redis':
			$constructor = new NoConstructConstructor();
			break;
		case 'filesystem':
		case 'mongo_db':
		case 'php_file':
		case 'riak':
			$constructor = new ConstructConstructor();
			break;
		default:
			throw new \Exception(sprintf('Unknown DoctrineCache type "%s"', $type));
			break;
		}

		return $constructor();

	}

	public function getInjectorForDoctrineCacheType($type, &$args)
	{
		$injector = null;
		switch($type) {
		case 'couchbase':
			if($couchbase = $this->getStorageFromArgs($args, 'couchbase')) {
				$injector = new MethodInjector('setMemcache', array($couchbase));
			}
			break;
		case 'memcache':
			if($memcache = $this->getStorageFromArgs($args, 'memcache')) {
				$injector = new MethodInjector('setMemcache', array($memcache));
			}
			break;
		case 'memcached':
			if($memcached = $this->getStorageFromArgs($args, 'memcached')) {
				$injector = new MethodInjector('setMemcached', array($memcached));
			}
			break;
		case 'redis':
			if($redis = $this->getStorageFromArgs($args, 'redis')) {
				$injector = new MethodInjector('setRedis', array($redis));
			}
			break;
		default:
		}

		return $injector;
	}

	public function isSupportedArgs(array $args = array())
	{
		return $this->isSupportedKeyArgs(Factory\Util::shiftArg($args, self::ARG_KEY), $args);
	}

	public function isSupportedKey($key)
	{
		return array_key_exists($key, self::$doctrineCacheClasses);
	}
	public function isSupportedKeyArgs($key, array $args = array())
	{
		switch($key) {
		case 'apc':
		case 'array':
			return true;
		case 'file_system':
		case 'php_file':
		case 'couchbase':
		case 'memcache':
		case 'memcached':
		case 'mongo_db':
		case 'redis':
		case 'riak':
			return 1 < count($args);
		default:
			break;
		}
		return false;
	}

	abstract protected function getCacheClass();
}

