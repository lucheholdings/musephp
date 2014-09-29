<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Adapter\SymfonyBundles\FrameworkBundle\Container\Map\Factory;

use Symfony\Component\DependencyInjection\ContainerInterface,
	Symfony\Component\DependencyInjection\ContainerAwareInterface
;
use Clio\Adapter\SymfonyBundles\FrameworkBundle\Cache\CacheFactoryInterface;
use Clio\Component\Pce\Construction\FactoryMap;

use Clio\Bridge\DoctrineCache\Container\CachedMap;

use Doctrine\Common\Cache\Cache as DoctrineCache;

class CachedMapFactoryMap extends FactoryMap implements ContainerAwareInterface 
{
	private $container;

	private $cacheFactory;

	public function __construct(ContainerInterface $container, CacheFactoryInterface $cacheFactory)
	{
		parent::__construct();

		$this->container = $container;
		$this->cacheFactory = $cacheFactory;
	}

	public function createArgs($alias, array $args = array(), $cache = null)
	{
		// 
		$map = parent::createArgs($alias, $args);

		if($cache) {
			$map = $this->createCachedMap($map, $cache);
		}

		return $map; 
	}

	/**
	 * create 
	 *   $factory->create($alias, $cache, $arg1, $arg2...) 
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
    
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        return $this;
    }
    
    public function getCacheFactory()
    {
        return $this->cacheFactory;
    }
    
    public function setCacheFactory(CacheFactoryInterface $cacheFactory)
    {
        $this->cacheFactory = $cacheFactory;
        return $this;
    }
}

