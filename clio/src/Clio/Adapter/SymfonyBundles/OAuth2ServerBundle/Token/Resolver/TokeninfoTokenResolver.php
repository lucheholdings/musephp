<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Token\Resolver;

use Symfony\Component\HttpFoundation\Request;
use Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Token\Resolver;
use Clio\Component\Auth\OAuth2\Token\Provider\TokeninfoTokenProviderInterface;
use Clio\Component\Auth\OAuth2\User\Provider\UserinfoProviderInterface;
use Clio\Component\Auth\OAuth2\Token\ChainedToken;

class TokeninfoTokenResolver extends ClientTokenResolver
{
	/**
	 * tokenProvider 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $tokenProvider;

	/**
	 * __construct 
	 * 
	 * @param TokeninfoTokenProviderInterface $provider 
	 * @access public
	 * @return void
	 */
	public function __construct(TokeninfoTokenProviderInterface $provider)
	{
		$this->tokenProvider = $provider;
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
		$token = $this->getTokenProvider()->getTokeninfo($this->getAccessToken($request));

		return $token;
	}
    
    /**
     * getTokenProvider 
     * 
     * @access public
     * @return void
     */
    public function getTokenProvider()
    {
        return $this->tokenProvider;
    }
    
    /**
     * setTokenProvider 
     * 
     * @param mixed $tokenProvider 
     * @access public
     * @return void
     */
    public function setTokenProvider($tokenProvider)
    {
        $this->tokenProvider = $tokenProvider;
        return $this;
    }
}

