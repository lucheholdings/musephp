<?php
namespace Terpsichore\Bundle\OAuth2ServerBundle\User;

use Clio\Component\Auth\OAuth2\User\Provider\UserinfoProvider;
use Doctrine\Common\Cache\Cache;

/**
 * CachedUserinfoProvider 
 * 
 * @uses UserinfoProvider
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class CachedUserinfoProvider implements UserinfoProvider 
{
	/**
	 * cache 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $cache;

	/**
	 * provider 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $provider;

	/**
	 * ttl 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $ttl;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(UserinfoProvider $provider, Cache $cache)
	{
		$this->cache = $cache;
		$this->provider = $provider;
		$this->ttl = 10;
	}

	/**
	 * getUserinfo 
	 * 
	 * @param mixed $token 
	 * @access public
	 * @return void
	 */
	public function getUserinfo($token, $ttl = null)
	{
		//
		if($this->getCache()->contains($token)) {
			return $this->getCache()->fetch($token);
		}

		$userinfo = $this->getProvider()->getUserinfo($token);

		$this->getCache()->save($token, $userinfo, $ttl ?: $this->getTtl());

		return $userinfo;
	}

	/**
	 * getUserId 
	 * 
	 * @access public
	 * @return void
	 */
	public function getUserId($token, $ttl = null)
	{
		$userinfo = $this->getUserinfo($token, $ttl);

		return $userinfo && isset($userinfo['id']) ? $userinfo['id'] : null;
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
     * getProvider 
     * 
     * @access public
     * @return void
     */
    public function getProvider()
    {
        return $this->provider;
    }
    
    /**
     * setProvider 
     * 
     * @param mixed $provider 
     * @access public
     * @return void
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
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
}

