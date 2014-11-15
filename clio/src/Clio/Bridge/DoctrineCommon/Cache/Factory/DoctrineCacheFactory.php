<?php
namespace Clio\Bridge\DoctrineCommon\Cache\Factory;

use Clio\Bridge\DoctrineCommon\Cache\DoctrineCache;


class DoctrineCacheFactory extends AbstractDoctrineCacheFactory 
{
	protected function getCacheClass()
	{
		return new \ReflectionClass('Clio\Bridge\DoctrineCommon\Cache\DoctrineCache');
	}

}

