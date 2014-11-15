<?php
namespace Clio\Bridge\DoctrineCommon\Cache\Tests;

use Clio\Bridge\DoctrineCommon\Cache\DoctrineCacheProvider;
use Doctrine\Common\Cache\ArrayCache;

class DoctrineCacheProviderTest extends \PHPUnit_Framework_TestCase 
{
	private $doctrineCache;

	public function setUp()
	{
		$this->doctrineCache = new ArrayCache();
	}

	public function testSuccess()
	{
		$provider = $this->createCacheProvider();

		$this->assertFalse($provider->contains('hoge'));

		$provider->save('hoge', 'Hoge');

		$this->assertTrue($provider->contains('hoge'));

		$data = $provider->fetch('hoge');
		$this->assertEquals('Hoge', $data);
		$this->assertTrue($provider->contains('hoge'));

		$provider->delete('hoge');
		$this->assertFalse($provider->contains('hoge'));
	}

	protected function createCacheProvider()
	{
		return new DoctrineCacheProvider($this->doctrineCache);
	}
}

