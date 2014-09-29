<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace CLio\Adapter\SymfonyBundles\FrameworkBundle\Kvs\Factory;

use Symfony\Component\DependencyInjection\ContainerInterface,
	Symfony\Component\DependencyInjection\ContainerAwareInterface
;

use Doctrine\Common\Cache\Cache as DoctrineCache;
use Clio\Bridge\DoctrineCache\Container\CachedMap;


class KvsFactoryMap extends FactoryMap implements ContainerAwareInterface 
{
	private $container;

	private $cacheFactory;

	public function createArgs($alias, $cache = null, array $args = array())
	{
		// 
		$map = parent::createArgs($alias, $args);

		if($cache) {
			$map = $this->createCachedMap($map, $cacheType);
		}

		return $map; 
	}

	/**
	 * create 
	 *   
	 * @access public
	 * @param  string Alias of Factory 
	 * @param  string "array" or Alias of Cache in DI
	 * @return void
	 */
	public function create()
	{
		$args = func_get_args();

		$alias = array_shift($args);
		$cache = array_shift($args);

		return $this->createArgs($alias, $cache, $args);
	}



	protected function createCachedMap($map, $cache)
	{
		// Create DoctrineCache if needed
		if(is_string($cache) && $this->getContainer()->has($cache)) {
			// 1st, try to get the service
			$cache = $this->getContainer()->get($cache);	
		}

		if(!$cache instanceof DoctrineCache) {
			$cache = $this->getCacheFactory()->create($cache);
		}

		return new CachedMap($map, $cache);
	}
    
    public function getContainer()
    {
        return $this->container;
    }
    
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
        return $this;
    }
    
    public function getCacheFactory()
    {
        return $this->cacheFactory;
    }
    
    public function setCacheFactory($cacheFactory)
    {
        $this->cacheFactory = $cacheFactory;
        return $this;
    }
}

