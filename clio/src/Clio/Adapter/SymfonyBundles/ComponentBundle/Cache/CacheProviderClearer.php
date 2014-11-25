<?php
namespace Clio\Adapter\SymfonyBundles\ComponentBundle\Cache;

use Symfony\Component\HttpKernel\CacheClearer\CacheClearerInterface;
use Clio\Component\Util\Cache\CacheProvider;

/**
 * CacheProviderClearer 
 * 
 * @uses CacheClearerInterface
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class CacheProviderClearer implements CacheClearerInterface
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
	 * @param CacheProvider $cacheProvider 
	 * @access public
	 * @return void
	 */
	public function __construct(CacheProvider $cacheProvider)
	{
		$this->cacheProvider = $cacheProvider;
	}

	/**
	 * clear 
	 * 
	 * @param mixed $cacheDir 
	 * @access public
	 * @return void
	 */
	public function clear($cacheDir)
	{
		// Clear all cache
		$this->cacheProvider->flush();
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
     * setCache 
     * 
     * @param mixed $cacheProvider 
     * @access public
     * @return void
     */
    public function setCacheProvider(CacheProvider $cacheProvider)
    {
        $this->cacheProvider = $cacheProvider;
        return $this;
    }
}

