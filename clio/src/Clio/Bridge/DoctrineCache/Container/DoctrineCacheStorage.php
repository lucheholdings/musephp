<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Bridge\DoctrineCache\Container;

use Clio\Component\Util\Container\Storage\RandomAccessStorage;

use Doctrine\Common\Cache\Cache;

/**
 * DoctrineCacheStorage
 * 
 * @package ${ PACKAGE }
 * @subpackage 
 * @author ${ AUTHOR }
 */
class DoctrineCacheStorage implements RandomAccessStorage
{
	private $cache;

	public function __construct(Cache $cache)
	{
		$this->cache = $cache;
	}
    
    public function getCache()
    {
        return $this->cache;
    }
    
    public function setCache($cache)
    {
        $this->cache = $cache;
        return $this;
    }

	/**
	 * load 
	 * 
	 * @access public
	 * @return void
	 */
	public function load()
	{
	}

	/**
	 * save 
	 * 
	 * @access public
	 * @return void
	 */
	public function save()
	{
	}

	/**
	 * count 
	 * 
	 * @access public
	 * @return void
	 */
	public function count()
	{
		// 
		throw new \Clio\Component\Exception\RuntimeException('Memcached RandomAccessStorage');
	}


	/**
	 * setAt 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function setAt($key, $value)
	{
		if(!$this->cache->save($key, $value)) {
			throw new \Clio\Component\Exception\RuntimeException(sprintf('Failed to set "%s" on cache.', $key));		
		}
	}

	/**
	 * getAt 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function getAt($key)
	{
		return $this->cache->fetch($key);
	}

	/**
	 * removeAt 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function removeAt($key)
	{
		$this->cache->delete($key);
	}

	/**
	 * existsAt 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function existsAt($key)
	{
		return (bool)$this->cache->contains($key);
	}
}

