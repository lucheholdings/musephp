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
	 * __construct 
	 * 
	 * @param EntryLoader $loader 
	 * @param CacheProvider $cacheProvider 
	 * @access public
	 * @return void
	 */
	public function __construct(EntryLoader $loader, CacheProvider $cacheProvider = null)
	{
		parent::__construct($loader);

		$this->cacheProvider = $cacheProvider;
	}

	/**
	 * {@inheritdoc}
	 */
	public function loadEntry($key)
	{
		if($this->cacheProvider->contains($key)) {
			$entry = $this->cacheProvider->fetch($key);
			
			// rebuild entry if needed
			$this->injector->inject($entry);
		} else {
			$entry = $this->getLoader()->loadEntry($key);
			// Save
			$this->cacheProvider->save($key, $entry);
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
}

