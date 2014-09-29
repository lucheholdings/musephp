<?php
namespace Terpsichore\Bundle\OAuth2ServerBundle\DoctrineCache;

use Doctrine\Common\Cache\Cache;
use Terpsichore\Bundle\OAuth2ServerBundle\Storage\Strategy\StorageStrategy;
/**
 * DoctrineCacheManager 
 * 
 * @uses ManagerInterface
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class DoctrineCacheStorage implements StorageStrategy
{
	/**
	 * cache 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $cache;

	/**
	 * class 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $class;

	/**
	 * logger 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $logger;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(Cache $cache, $class, $logger = null)
	{
		$this->cache = $cache;
		$this->class = $class;
	}

	public function getClass()
	{
		return $this->class;
	}

	/**
	 * create 
	 * 
	 * @access public
	 * @return void
	 */
	public function create()
	{
		$args = func_get_args();
		// Create Instance with arguments
		$reflection = new \ReflectionClass($this->getClass());
		return $reflection->newInstanceArgs($args);
	}

	/**
	 * getCache 
	 * 
	 * @access public
	 * @return Doctrine\Common\Cache\Cache
	 */
	public function getCache()
	{
		return $this->cache;
	}
    
    /**
     * Get logger.
     *
     * @access public
     * @return logger
     */
    public function getLogger()
    {
        return $this->logger;
    }
    
    /**
     * Set logger.
     *
     * @access public
     * @param logger the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
        return $this;
    }
}

