<?php
namespace Terpsichore\Bundle\OAuth2ServerBundle\Token\Resolver;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Cache\Cache;
/**
 * CachedClientTokenResolver 
 * 
 * @uses ClientTokenResolver
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class CachedClientTokenResolver extends ClientTokenResolver
{
	private $cache;

	private $resolver;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(ClientTokenResolver $resolver, Cache $cache)
	{
		$this->resolver = $resolver;
		$this->cache = $cache;
	}

	/**
	 * resolveToken 
	 * 
	 * @param Request $request 
	 * @access public
	 * @return void
	 */
	public function resolveToken(Request $request)
	{
		$accessToken = $this->getAccessToken($request);	

		if($this->getCache()->contains($accessToken)) {
			return $this->getCache()->fetch($accessToken);
		}

		$token = $this->getResolver()->resolveToken($request);

		$this->getCache()->save($accessToken, $token, $token->getExpiresIn());

		return $token;
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
     * getResolver 
     * 
     * @access public
     * @return void
     */
    public function getResolver()
    {
        return $this->resolver;
    }
    
    /**
     * setResolver 
     * 
     * @param mixed $resolver 
     * @access public
     * @return void
     */
    public function setResolver($resolver)
    {
        $this->resolver = $resolver;
        return $this;
    }
}

