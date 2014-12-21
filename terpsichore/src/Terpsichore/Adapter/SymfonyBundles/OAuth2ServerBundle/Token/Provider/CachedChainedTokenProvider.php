<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Token\Provider;

use Doctrine\Common\Cache\Cache;

/**
 * CachedChainedTokenProvider 
 * 
 * @uses ChainGrantTokenProviderInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class CachedChainedTokenProvider implements ChainGrantTokenProviderInterface
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
	 * __construct 
	 * 
	 * @param Cache $cache 
	 * @param ChainGrantTokenProviderInterface $provider 
	 * @access public
	 * @return void
	 */
	public function __construct(Cache $cache, ChainGrantTokenProviderInterface $provider)
	{
		$this->cache = $cache;
		$this->provider = $provider;
	}

	/**
	 * getTokenWithChainGrant 
	 * 
	 * @param mixed $token 
	 * @param array $scopes 
	 * @param array $configs 
	 * @access public
	 * @return void
	 */
	public function getTokenWithChainGrant($token, array $scopes = array(), array $options = array())
	{
		$originalToken = $token;
		if($this->getCache()->contains($originalToken)) {
			return $this->getCache()->fetch($originalToken);
		}

		// 
		$chainedToken = $this->getProvider()->getTokenWithChainGrant($token, $scopes, $options);

		if(!$chainedToken) {
			return null;
		}

		// Save into cache
		$this->getCache()->save($originalToken, $chainedToken, $chainedToken->getExpiresIn());

		return $chainedToken;
	}

	public function getToken($configs = array())
	{
		return $this->getProvider()->getToken($configs);
	}
    
    /**
     * Get cache.
     *
     * @access public
     * @return cache
     */
    public function getCache()
    {
        return $this->cache;
    }
    
    /**
     * Set cache.
     *
     * @access public
     * @param cache the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setCache($cache)
    {
        $this->cache = $cache;
        return $this;
    }
    
    /**
     * Get provider.
     *
     * @access public
     * @return provider
     */
    public function getProvider()
    {
        return $this->provider;
    }
    
    /**
     * Set provider.
     *
     * @access public
     * @param provider the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
        return $this;
    }
}

