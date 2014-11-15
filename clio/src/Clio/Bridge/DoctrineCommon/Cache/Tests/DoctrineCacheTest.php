<?php
namespace Clio\Bridge\DoctrineCommon\Cache\Tests;

use Clio\Bridge\DoctrineCommon\Cache\DoctrineCache;
use Doctrine\Common\Cache\ArrayCache;

class DoctrineCacheTest extends \PHPUnit_Framework_TestCase 
{
	private $doctrineCache;

	public function setUp()
	{
		$this->doctrineCache = new ArrayCache();
	}

	public function testSuccess()
	{
		$cache = $this->createCache();

		$cache->setName('test');
		$this->assertFalse($cache->isCached());
		$this->assertFalse($cache->isExists());

		$cache->setData('hoge');
		$cache->save();

		$this->assertTrue($cache->isCached());
		$cache->load();

		$this->assertEquals('hoge', $cache->getData());
		$this->assertTrue($cache->isExists());

		$cache->delete();
		$this->assertFalse($cache->isExists());
	}

	protected function createCache()
	{
		return new DoctrineCache($this->doctrineCache);
	}
}

