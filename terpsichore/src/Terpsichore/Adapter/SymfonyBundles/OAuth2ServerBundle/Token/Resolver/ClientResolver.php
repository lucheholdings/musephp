<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Token\Resolver;

use Symfony\Component\HttpFoundation\Request;
use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Token\Resolver;
use Clio\Component\Auth\OAuth2\Exception as OAuth2Exceptions;

/**
 * ClientResolver 
 * 
 * @uses Resolver
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class ClientResolver implements Resolver 
{
	/**
	 * getAccessToken 
	 * 
	 * @param Request $request 
	 * @access public
	 * @return void
	 */
	public function getAccessToken(Request $request)
	{
		$accessToken = null;

		// Get AccessToken from Request
		$requestToken = $request->headers->get('Authorization');
	
		$matches = array();
		if(preg_match('/^Bearer\s(?P<token>\S+)$/', $requestToken, $matches)) {
			$accessToken = $matches['token'];
		} else {
			throw new OAuth2Exceptions\InvalidRequestException('specify valid access token');
		}

		return $accessToken;
	}
}

