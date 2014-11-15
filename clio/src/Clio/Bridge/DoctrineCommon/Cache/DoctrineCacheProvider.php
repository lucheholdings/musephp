<?php
namespace Clio\Bridge\DoctrineCommon\Cache;

use Clio\Component\Util\Cache\CacheProvider;
use Doctrine\Common\Cache\CacheProvider as DoctrineCacheProviderInterface;
/**
 * DoctrineCacheProvider 
 * 
 * @uses CacheProvider
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class DoctrineCacheProvider implements CacheProvider
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
	 * @param DoctrineCacheProviderInterface $cacheProvider 
	 * @access public
	 * @return void
	 */
	public function __construct(DoctrineCacheProviderInterface $cacheProvider)
	{
		$this->cacheProvider = $cacheProvider;
	}

	/**
	 * {@inheritdoc}
	 */
	public function add(Cache $cache)
	{
		$this->save($cache->getName(), $cache->getData());
	}

	/**
	 * {@inheritdoc}
	 */
	public function save($id, $data, $ttl = 0)
	{
		return $this->getCacheProvider()->save($id, $data, $ttl);
	}

	/**
	 * {@inheritdoc}
	 */
	public function fetch($id)
	{
		return $this->getCacheProvider()->fetch($id);
	}

	/**
	 * {@inheritdoc}
	 */
	public function contains($id)
	{
		return $this->getCacheProvider()->contains($id);
	}

	/**
	 * {@inheritdoc}
	 */
	public function delete($id)
	{
		return $this->getCacheProvider()->delete($id);
	}

	/**
	 * {@inheritdoc}
	 */
	public function flush()
	{
		return $this->getCacheProvider()->flushAll();
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
     * @param mixed $cacheProvider 
     * @access public
     * @return void
     */
    public function setCacheProvider(DoctrineCacheProviderInterface $cacheProvider)
    {
        $this->cacheProvider = $cacheProvider;
        return $this;
    }
}

