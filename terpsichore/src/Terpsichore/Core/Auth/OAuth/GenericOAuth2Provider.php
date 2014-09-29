<?php
namespace Terpsichore\Core\Auth\OAuth;

use Terpsichore\Core\Auth\Token;
/**
 * GenericOAuth2Service 
 *    OAuth2 Authentication Service Client
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class GenericOAuth2Provider extends AbstractOAuthProvider
{
	protected function doAuthenticate(Token $token)
	{
		$this->getClient()->send($this->getUrl('token'), array('method' => 'get'));
		// 
		throw new \Exception('Not Impl');
	}

	public function getTokenByClientCredentials($clientId, $clientSecret)
	{
		$token = new OAuth2Token($token, $id, $secret);
		// 
		
	}

	protected function isValidToken(Token $token)
	{
		return ($token instanceof OAuth2Token);
	}
}

