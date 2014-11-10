<?php
namespace Erato\Adapter\SymfonyBundles\FrameworkBundle\Cache;

use Symfony\Component\HttpKernel\CacheClearer\CacheClearerInterface;
use Doctrine\Common\Cache\Cache;

/**
 * CacheClearer 
 * 
 * @uses CacheClearerInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class CacheClearer implements CacheClearerInterface
{
	/**
	 * cache 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $cache;

	/**
	 * __construct 
	 * 
	 * @param Cache $cache 
	 * @access public
	 * @return void
	 */
	public function __construct(Cache $cache)
	{
		$this->cache = $cache;
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
		$this->cache->flushAll();
	}
    
    /**
     * getCache 
     * 
     * @access public
     * @return void
     */
    public function getCache()
    {
        return $this->cache;
    }
    
    /**
     * setCache 
     * 
     * @param mixed $cache 
     * @access public
     * @return void
     */
    public function setCache($cache)
    {
        $this->cache = $cache;
        return $this;
    }
}

