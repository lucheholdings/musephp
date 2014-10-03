<?php
namespace Terpsichore\Core\Auth\OAuth;

use Terpsichore\Core\Auth\Token;
use Terpsichore\Core\Auth\OAuth\OAuth2Token as OAuth2TokenInterface;
use Terpsichore\Core\Auth\OAuth\Token\OAuth2Token;
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
	public function clientCredentials()
	{
		$request  = $this->createHttpRequest(
			$this->getUri(), $this->getMethod(),
			array(
				'client_id' => $token->getClientId(),
				'client_secret' => $token->getClientSecret(),
				'grant_type' => 'client_credentials',
			)
		);
	}

	public function passwordCredentials()
	{
	}

	public function authCode()
	{
	}
	protected function doAuthenticate(Token $token)
	{
		$response = $this->request($this->createHttpAuthenticationRequest($this->getUri(), $this->getMethod()));
		
		$token = new OAuth2Token($this);
		$token
			->setToken($response['access_token'])
			->setType($response['token_type'])
			->setExpiresIn($response['expires_in'])
			->setScopes($response['scope'])
		;
		if(isset($response['response_token'])) {
			$token
				->setRefreshToken($response['refresh_token'])
			;
		}

		return $token;
	}

	public function getTokenByClientCredentials($clientId, $clientSecret)
	{
		$token = new OAuth2Token($token, $id, $secret);
		// 
	}

	protected function isValidToken(Token $token)
	{
		return ($token instanceof OAuth2TokenInterface);
	}
}

