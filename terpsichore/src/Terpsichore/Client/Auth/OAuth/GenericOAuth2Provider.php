<?php
namespace Terpsichore\Client\Auth\OAuth;

use Terpsichore\Client\Auth\Token;
use Terpsichore\Client\Auth\OAuth\OAuth2Token as OAuth2TokenInterface;
use Terpsichore\Client\Auth\OAuth\Token\OAuth2Token;
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
	public function clientCredentials(Token $reqToken)
	{
		$token = clone $reqToken;
		$token
			->set('grant_type', 'client_credentials')
		;

		return $this->doAuthenticate($token);
	}

	public function passwordCredentials()
	{
	}

	public function authCode()
	{
	}

	/**
	 * doAuthenticate 
	 *     
	 * @param Token $token 
	 * @access protected
	 * @return void
	 */
	protected function doAuthenticate(Token $token)
	{
		$response = $this->request($this->createHttpRequest(
			$this->getUri(), 
			$this->getMethod(), 
			// Body
			$this->createRequestBodyFromToken($token)
		));

		if(!$response) {
			throw new \RuntimeException('Failed to authenticate.');
		}


		// Create Token from the response
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

		return $token;
	}

	protected function createRequestBodyFromToken(Token $token)
	{
		$grantType = $token->get('grant_type');
		switch($grantType) {
		case 'auth_code':
			break;
		case 'client_credentials':
			$contents = array(
				'grant_type'    => 'client_credentials',
				'client_id'     => $token->get('client_id'),
				'client_secret' => $token->get('client_secret'),
				'scope'         => $token->get('scope'),
			);
			break;
		case 'password':
			break;
		default:
			throw new \Exception(sprintf('Invalid type of grant "%s".', $grantType));
			break;
		}

		return $contents;
	}

	protected function isValidToken(Token $token)
	{
		return ($token instanceof OAuth2TokenInterface);
	}
}

