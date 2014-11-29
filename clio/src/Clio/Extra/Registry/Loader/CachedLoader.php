<?php
namespace Clio\Extra\Registry\Loader;

use Clio\Component\Pattern\Registry\Loader\ProxyLoader,
	Clio\Component\Pattern\Registry\EntryLoader
;
use Clio\Component\Util\Cache\CacheProvider;

/**
 * CachedLoader 
 * 
 * @uses ProxyLoader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class CachedLoader extends ProxyLoader 
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

	/**
	 * __construct 
	 * 
	 * @param EntryLoader $loader 
	 * @param CacheProvider $cacheProvider 
	 * @param Injector $cacheWarmer 
	 * @access public
	 * @return void
	 */
	public function __construct(EntryLoader $loader, CacheProvider $cacheProvider = null, CacheWarmer $cacheWarmer = null)
	{
		parent::__construct($loader);

		$this->cacheWarmer = $cacheWarmer;
		$this->cacheProvider = $cacheProvider;
	}

	/**
	 * {@inheritdoc}
	 */
	public function loadEntry($key)
	{
		if($this->cacheProvider->contains($key)) {
			$entry = $this->cacheProvider->fetch($key);
			
			// Warmup cache
			if($this->getCacheWarmer()) {
				$entry = $this->getCacheWarmer()->warmup($entry);
			}
		} else {
			$entry = $this->getLoader()->loadEntry($key);
			// Save
			$this->cacheProvider->save($key, $entry, $this->getTtl());
		}

		return $entry;
	}

	/**
	 * {@inheritdoc}
	 */
	public function canLoad($key)
	{
		return $this->cacheProvider->contains($key) || $this->getLoader()->canLoad($key);
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

