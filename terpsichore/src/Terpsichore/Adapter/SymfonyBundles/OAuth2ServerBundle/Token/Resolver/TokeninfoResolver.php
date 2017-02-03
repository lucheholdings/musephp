<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Token\Resolver;

use Symfony\Component\HttpFoundation\Request;
use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Token\Resolver;
use Clio\Component\Auth\OAuth2\Token\Provider\TokeninfoProviderInterface;
use Clio\Component\Auth\OAuth2\User\Provider\UserinfoProviderInterface;
use Clio\Component\Auth\OAuth2\Token\ChainedToken;

/**
 * TokeninfoResolver 
 *   TokeninfoResolver is a RequestTokenResolver which 
 *   Convert requestToken to ServerSide Token with tokeninfo API.
 *   
 * @uses ClientResolver
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TokeninfoResolver extends ClientResolver
{
	/**
	 * tokeninfoProvider 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $tokeninfoProvider;

	/**
	 * __construct 
	 * 
	 * @param TokeninfoProviderInterface $provider 
	 * @access public
	 * @return void
	 */
	public function __construct(TokeninfoProviderInterface $provider)
	{
		$this->tokeninfoProvider = $provider;
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
		$tokeninfo = $this->getTokeninfoProvider()->getTokeninfo($this->getAccessToken($request));

		$token = new DelegatedToken();
		$token
			->setClientId($tokeninfo->getClientId())
			->setExpiresIn($tokeninfo->getExpiresIn())
		;

		if($tokeninfo->hasUserId()) {
			$token->setUserId($tokeninfo->getUserId());
		}

		return $token;
	}
    
    /**
     * getTokeninfoProvider 
     * 
     * @access public
     * @return void
     */
    public function getTokeninfoProvider()
    {
        return $this->tokeninfoProvider;
    }
    
    /**
     * setTokeninfoProvider 
     * 
     * @param mixed $tokeninfoProvider 
     * @access public
     * @return void
     */
    public function setTokeninfoProvider($tokeninfoProvider)
    {
        $this->tokeninfoProvider = $tokeninfoProvider;
        return $this;
    }
}

