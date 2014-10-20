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
use Clio\Component\Pattern\Factory\FactoryCollection;

use Clio\Bridge\DoctrineCache\Container\CachedMap;

use Doctrine\Common\Cache\Cache as DoctrineCache;

class CachedMapFactoryMap extends FactoryCollection implements ContainerAwareInterface 
{
	private $container;

	private $cacheFactory;

	public function __construct(ContainerInterface $container, CacheFactoryInterface $cacheFactory)
	{
		parent::__construct();

		$this->container = $container;
		$this->cacheFactory = $cacheFactory;
	}

	protected function doCreate(array $args)
	{
		$key = array_shift($args);
		$cache = array_shift($args);

		return $this->createCachedMapArgs($key, $cache, $args);
	}

	public function createCachedMapArgs($key, $cache = null, array $args = array())
	{
		// 
		$map = parent::createByKeyArgs($key, $args);

		// If Cache is enabled, then create CachedMap with $map and $cache
		if($cache) {
			$map = $this->doCreateCachedMap($map, $cache);
		}

		return $map; 
	}

	/**
	 * createCachedMap 
	 * 
	 * @param mixed $map 
	 * @param mixed $cache 
	 * @access protected
	 * @return void
	 */
	protected function doCreateCachedMap($map, $cache)
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
    
    /**
     * getContainer 
     * 
     * @access public
     * @return void
     */
    public function getContainer()
    {
        return $this->container;
    }
    
    /**
     * setContainer 
     * 
     * @param ContainerInterface $container 
     * @access public
     * @return void
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        return $this;
    }
    
    /**
     * getCacheFactory 
     * 
     * @access public
     * @return void
     */
    public function getCacheFactory()
    {
        return $this->cacheFactory;
    }
    
    /**
     * setCacheFactory 
     * 
     * @param CacheFactoryInterface $cacheFactory 
     * @access public
     * @return void
     */
    public function setCacheFactory(CacheFactoryInterface $cacheFactory)
    {
        $this->cacheFactory = $cacheFactory;
        return $this;
    }
}

