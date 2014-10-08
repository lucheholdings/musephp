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
	/**
	 * container 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $container;

	/**
	 * cacheFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $cacheFactory;

	/**
	 * __construct 
	 * 
	 * @param ContainerInterface $container 
	 * @param mixed $cacheFactory 
	 * @access public
	 * @return void
	 */
	public function __construct(ContainerInterface $container = null, $cacheFactory = null)
	{
		$this->container = $container;
		$this->cacheFactory = $cacheFactory;
	}

	/**
	 * doCreate 
	 * 
	 * @param array $args 
	 * @access protected
	 * @return void
	 */
	protected function doCreate(array $args)
	{
		$key = array_shift($args);
		$cache = array_shift($args);

		return $this->createKvsByKeyArgs($key, $cache, $args);
	}

	/**
	 * createKvsByKeyArgs 
	 * 
	 * @param mixed $key 
	 * @param mixed $cache 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function createKvsByKeyArgs($key, $cache = null, array $args = array())
	{
		//  
		$map = parent::createByKeyArgs($key, $args);

		if($cache) {
			$map = $this->doCreateCachedMap($map, $cacheType);
		}

		return $map; 
	}

	/**
	 * doCreateCachedMap 
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
    public function setContainer(ContainerInterface $container)
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
     * @param mixed $cacheFactory 
     * @access public
     * @return void
     */
    public function setCacheFactory($cacheFactory)
    {
        $this->cacheFactory = $cacheFactory;
        return $this;
    }
}

