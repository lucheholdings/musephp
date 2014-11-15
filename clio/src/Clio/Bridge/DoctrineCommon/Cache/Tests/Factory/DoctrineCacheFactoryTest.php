<?php
namespace Clio\Bridge\DoctrineCommon\Cache\Tests\Factory;

use Clio\Bridge\DoctrineCommon\Cache\Factory\DoctrineCacheFactory;

class DoctrineCacheFactoryTest extends \PHPUnit_Framework_TestCase 
{
	public function testSupported()
	{
		$factory = new DoctrineCacheFactory();

		$this->assertTrue($factory->isSupportedKey('apc'));
		$this->assertTrue($factory->isSupportedKey('array'));
		$this->assertTrue($factory->isSupportedKey('file_system'));
		$this->assertTrue($factory->isSupportedKey('couchbase'));
		$this->assertTrue($factory->isSupportedKey('memcache'));
		$this->assertTrue($factory->isSupportedKey('memcached'));
		$this->assertTrue($factory->isSupportedKey('mongo_db'));
		$this->assertTrue($factory->isSupportedKey('redis'));
		$this->assertTrue($factory->isSupportedKey('riak'));

	}

	public function testCreateArrayCache()
	{
		$factory = new DoctrineCacheFactory();

		$cache = $factory->create('array');
		$this->assertInstanceOf('Clio\Bridge\DoctrineCommon\Cache\DoctrineCache', $cache);
		$this->assertInstanceOf('Doctrine\Common\Cache\ArrayCache', $cache->getCacheProvider());

		$cache = $factory->createByKey('array', array());
		$this->assertInstanceOf('Clio\Bridge\DoctrineCommon\Cache\DoctrineCache', $cache);
		$this->assertInstanceOf('Doctrine\Common\Cache\ArrayCache', $cache->getCacheProvider());
	}

	public function testCreateFileSystem()
	{
		$factory = new DoctrineCacheFactory();

		$cache = $factory->create('file_system', __DIR__);
		$this->assertInstanceOf('Clio\Bridge\DoctrineCommon\Cache\DoctrineCache', $cache);
		$this->assertInstanceOf('Doctrine\Common\Cache\FileSystemCache', $cache->getCacheProvider());
	}
}

