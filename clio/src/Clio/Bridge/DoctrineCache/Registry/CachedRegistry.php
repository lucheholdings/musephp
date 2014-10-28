<?php
namespace Clio\Bridge\DoctrineCache\Registry;

use Doctrine\Common\Cache\Cache;
use Clio\Component\Pattern\Registry\Registry,
	Clio\Component\Pattern\Registry\ProxyRegistry
;
use Clio\Component\Util\Execution\Invokable;


/**
 * CachedRegistry 
 * 
 * @uses Registry
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class CachedRegistry extends ProxyRegistry implements Registry
{
	/**
	 * cache 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $cache;

	/**
	 * ttl 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $ttl;

	/**
	 * rebuilder 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $rebuilder;

	/**
	 * __construct 
	 * 
	 * @param Registry $registry 
	 * @param Cache $cache 
	 * @access public
	 * @return void
	 */
	public function __construct(Registry $registry, Cache $cache, $ttl = 0, Invokable $rebuilder = null)
	{
		parent::__construct($registry);
		$this->cache    = $cache;
		$this->ttl      = $ttl;
		$this->rebuilder  = $rebuilder;
	}

	public function has($key)
	{
		if($this->getRegistry()->has($key)) {
			return true;
		}

		// 
		return $this->cache->contains($key);
	}

	/**
	 * {@inheritdoc}
	 */
	public function get($key)
	{
		if(!$this->getRegistry()->has($key)) {
			if($this->cache->contains($key)) {
				// Load from cache

				$entry = $this->cache->fetch($key);
			
				// Additional callback to build the deserialize object
				$rebuilder = $this->getRebuilder();
				if($rebuilder) {
					$rebuilder($entry);
				}

				$this->getRegistry()->set($key, $entry);
			}
		}

		return $this->getRegistry()->get($key);
	}

	/**
	 * {@inheritdoc}
	 */
	public function set($key, $entry) 
	{
		$this->getRegistry()->set($key, $entry);
		$this->cache->save($key, $entry, $this->getTtl());

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function remove($key)
	{
		$this->cache->remove($key);

		return $this->getRegistry()->remove($key);
	}

	/**
	 * {@inheritdoc}
	 */
	public function clear()
    {
		$this->cache->flushAll();
        return $this->getRegistry()->clear();
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
    
    /**
     * getTtl 
     * 
     * @access public
     * @return void
     */
    public function getTtl()
    {
        return $this->ttl;
    }
    
    /**
     * setTtl 
     * 
     * @param mixed $ttl 
     * @access public
     * @return void
     */
    public function setTtl($ttl)
    {
        $this->ttl = $ttl;
        return $this;
    }
    
    public function getRebuilder()
    {
        return $this->rebuilder;
    }
    
    public function setRebuilder(\Closure $rebuilder)
    {
        $this->rebuilder = $rebuilder;
        return $this;
    }
}

