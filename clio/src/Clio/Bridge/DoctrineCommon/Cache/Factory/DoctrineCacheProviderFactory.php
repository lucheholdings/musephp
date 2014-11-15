<?php
namespace Clio\Bridge\DoctrineCommon\Cache\Factory;



class DoctrineCacheProviderFactory extends AbstractDoctrineCacheFactory 
{
	protected function getCacheClass()
	{
		return new \ReflectionClass('Clio\Bridge\DoctrineCommon\Cache\DoctrineCacheProvider');
	}
}

