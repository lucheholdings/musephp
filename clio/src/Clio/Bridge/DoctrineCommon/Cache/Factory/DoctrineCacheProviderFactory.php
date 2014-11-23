<?php
namespace Clio\Bridge\DoctrineCommon\Cache\Factory;

class DoctrineCacheProviderFactory extends AbstractDoctrineCacheFactory 
{
	public function createCacheProvider($type, array $args = array())
	{
		return $this->createByKeyArgs($type, $args);
	}

	protected function getCacheClass()
	{
		return new \ReflectionClass('Clio\Bridge\DoctrineCommon\Cache\DoctrineCacheProvider');
	}
}

