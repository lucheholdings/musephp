<?php
namespace Clio\Extra\Loader;

use Clio\Component\Pattern\Loader;
use Clio\Component\Cache\CacheProvider;
use Clio\Component\Cache\Warmer as CacheWarmer;

/**
 * CacheLoader 
 * 
 * @uses ProxyLoader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class CacheLoader extends Loader\ProxyLoader 
{
	/**
	 * cacheProvider 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $cacheProvider;

	/**
	 * cacheWarmer 
	 *   CacheWarmer is a collection of injector which inject dependencies into the wokeup cache.
	 * @var mixed
	 * @access private
	 */
	private $cacheWarmer;

	/**
	 * ttl 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $ttl = 0;

	public function __construct(Loader\Loader $loader, CacheProvider $cacheProvider = null, CacheWarmer $cacheWarmer = null)
	{
		parent::__construct($loader);

		$this->cacheWarmer = $cacheWarmer;
		$this->cacheProvider = $cacheProvider;
	}

	/**
	 * {@inheritdoc}
	 */
	public function load($key, array $options = array())
	{
		try {
			if($this->cacheProvider && $this->cacheProvider->contains($key)) {
				$loaded = $this->cacheProvider->fetch($key);
				
				// Warmup cache
				if($this->cacheWarmer) {
					$loaded = $this->cacheWarmer->warmup($loaded);
				}
			} else {
				$loaded = $this->getLoader()->load($key, $options);
				// Save
				if($this->cacheProvider)
                    $this->cacheProvider->save($key, $loaded, $this->getTtl());
			}
		} catch(\Exception $ex) {
			throw new Loader\Exception\InvalidResourceException(sprintf('Failed to load for "%s"', (string)$key), 0, $ex);
		}

		return $loaded;
	}
    
    /**
     * getCacheProvider 
     * 
     * @access public
     * @return void
     */
    public function getCacheProvider()
    {
        return $this->cacheProvider;
    }
    
    /**
     * setCacheProvider 
     * 
     * @param CacheProvider $cacheProvider 
     * @access public
     * @return void
     */
    public function setCacheProvider(CacheProvider $cacheProvider)
    {
        $this->cacheProvider = $cacheProvider;
        return $this;
    }
    
    /**
     * getCacheWarmer 
     * 
     * @access public
     * @return void
     */
    public function getCacheWarmer()
    {
        return $this->cacheWarmer;
    }
    
    /**
     * setCacheWarmer 
     * 
     * @param mixed $cacheWarmer 
     * @access public
     * @return void
     */
    public function setCacheWarmer($cacheWarmer)
    {
        $this->cacheWarmer = $cacheWarmer;
        return $this;
    }
    
    public function getTtl()
    {
        return $this->ttl;
    }
    
    public function setTtl($ttl)
    {
        $this->ttl = (int)$ttl;
        return $this;
    }
}

