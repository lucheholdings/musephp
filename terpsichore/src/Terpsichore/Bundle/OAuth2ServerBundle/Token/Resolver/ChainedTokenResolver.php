<?php
namespace Terpsichore\Bundle\OAuth2ServerBundle\Token\Resolver;

use Symfony\Component\HttpFoundation\Request;
use Terpsichore\Bundle\OAuth2ServerBundle\Token\Resolver;
use Clio\Component\Auth\OAuth2\Token\Provider\ChainGrantTokenProviderInterface;
use Clio\Component\Auth\OAuth2\User\Provider\UserinfoProviderInterface;
use Clio\Component\Auth\OAuth2\Token\ChainedToken;

/**
 * ChainedTokenResolver 
 * 
 * @uses Resolver
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ChainedTokenResolver extends ClientTokenResolver
{
	/**
	 * tokenProvider 
	 *   ChainGrantTokenProviderInterface should be a client of the OAuth2 
	 * @var mixed
	 * @access private
	 */
	private $tokenProvider;

	/**
	 * __construct 
	 * 
	 * @param ClinetTokenProviderInterface $tokenProvider 
	 * @access public
	 * @return void
	 */
	public function __construct(ChainGrantTokenProviderInterface $tokenProvider)
	{
		$this->tokenProvider = $tokenProvider;
	}

	/**
	 * resolveToken 
	 *   fixme: currently only support Bearer
	 * 
	 * @param Request $request 
	 * @access public
	 * @return void
	 */
	public function resolveToken(Request $request)
	{
		$accessToken = $this->getAccessToken($request);
		// 
		$token = $this->getTokenProvider()->getTokenWithChainGrant($accessToken);

		return $token;
	}
    
    /**
     * Get tokenProvider.
     *
     * @access public
     * @return tokenProvider
     */
    public function getTokenProvider()
    {
		if(!$this->tokenProvider) {
			throw new \Exception('TokenProvider is not initialized yet.');
		}
        return $this->tokenProvider;
    }
    
    /**
     * Set tokenProvider.
     *
     * @access public
     * @param tokenProvider the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setTokenProvider($tokenProvider)
    {
        $this->tokenProvider = $tokenProvider;
        return $this;
    }
}

