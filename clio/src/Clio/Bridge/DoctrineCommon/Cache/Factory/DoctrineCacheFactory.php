<?php
namespace Clio\Bridge\DoctrineCommon\Cache\Factory;

use Clio\Bridge\DoctrineCommon\Cache\DoctrineCache;


class DoctrineCacheFactory extends AbstractDoctrineCacheFactory 
{
	public function createCache($type, array $args = array())
	{
		return $this->createByKeyArgs($type, $args);
	}

	protected function getCacheClass()
	{
		return new \ReflectionClass('Clio\Bridge\DoctrineCommon\Cache\DoctrineCache');
	}
}

