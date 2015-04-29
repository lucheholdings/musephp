<?php
namespace Clio\Bridge\DoctrineCommon\Cache;

use Clio\Component\Cache\Cache;
use Doctrine\Common\Cache\CacheProvider as DoctrineCacheProviderInterface;
/**
 * DoctrineCache 
 * 
 * @uses Cache
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class DoctrineCache implements Cache 
{
	/**
	 * cacheProvider 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $cacheProvider;

	/**
	 * name 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $name;

	/**
	 * data 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $data;

	/**
	 * cached 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $cached;

	/**
	 * __construct 
	 * 
	 * @param DoctrineCacheProviderInterface $cacheProvider 
	 * @param mixed $name 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	public function __construct(DoctrineCacheProviderInterface $cacheProvider, $name = null, $data = null)
	{
		$this->cacheProvider = $cacheProvider;
		$this->name = $name;
		$this->data = $data;

		$this->cached = false;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		if(!$this->name) {
			//
			throw new \Exception('Cache name is not initialized yet.');
		}

		return $this->name;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function setName($name)
	{
		$this->name = $name;
		$this->cached = false;
	}

	public function save($ttl = 0)
	{
		$saved = $this->getCacheProvider()->save($this->getName(), $this->getData(), $ttl);

		$this->cached = true;

		return $saved;
	}

	/**
	 * {@inheritdoc}
	 */
	public function load()
	{
		$this->data = $this->getCacheProvider()->fetch($this->getName());

		$this->cached = true;
		
		return $this->data;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isExists()
	{
		return $this->getCacheProvider()->contains($this->getName());
	}
    
	/**
	 * {@inheritdoc}
	 */
	public function delete()
	{
		$deleted = $this->getCacheProvider()->delete($this->getName());

		$this->cached = false;

		return $deleted;
	}
    
    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->data;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setData($data)
    {
        $this->data = $data;

		$this->cached = false;
        return $this;
    }

	/**
	 * {@inheritdoc}
	 */
	public function isCached()
	{
		return (bool)$this->cached;
	}
    
    public function getCacheProvider()
    {
        return $this->cacheProvider;
    }
    
    public function setCacheProvider(DoctrineCacheProviderInterface $cacheProvider)
    {
        $this->cacheProvider = $cacheProvider;
        return $this;
    }
}

