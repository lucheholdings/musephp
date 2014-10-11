<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Token\Resolver;

/**
 * TrustedResolver 
 *    TrustedResolver is not recommended resolver.
 *    This resolver just trust the client sent request token.
 *    
 *    
 * @uses ClientResolver
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TrustedResolver extends ClientResolver 
{
	public function resolveToken(Request $request)
	{
		$requestToken = $this->getAccessToken($request);

		$token = new Token();
		$token
			->setAccessToken($requestToken)
		;

		return $token;
	}
}

