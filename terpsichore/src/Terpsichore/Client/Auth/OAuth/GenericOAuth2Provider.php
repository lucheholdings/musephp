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
	/**
	 * clientCredentials 
	 * 
	 * @param Token $reqToken 
	 * @access public
	 * @return void
	 */
	public function clientCredentials(Token $reqToken)
	{
		$token = clone $reqToken;
		$token
			->set('grant_type', 'client_credentials')
		;

		return $this->doAuthenticate($token);
	}

	/**
	 * passwordCredentials 
	 * 
	 * @param Token $reqToken 
	 * @access public
	 * @return void
	 */
	public function passwordCredentials(Token $reqToken)
	{
		$token = clone $reqToken;
		$token
			->set('grant_type', 'password')
		;

		return $this->doAuthenticate($token);
	}

	/**
	 * authCode 
	 * 
	 * @access public
	 * @return void
	 */
	public function authCode(Token $reqToken)
	{
		$token = clone $reqToken;
		$token
			->set('grant_type', 'authorization_code')
		;

		return $this->doAuthenticate($token);
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
		} else if(!isset($response['access_token'])) {
			throw new \RuntimeException('Invalid response.');
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

	/**
	 * createRequestBodyFromToken 
	 * 
	 * @param Token $token 
	 * @access protected
	 * @return void
	 */
	protected function createRequestBodyFromToken(Token $token)
	{
		$grantType = $token->get('grant_type');
		switch($grantType) {
		case 'authorization_code':
			$contents = array(
				'code'          => $token->get('code'),
				'redirect_uri'  => $token->get('redirect_uri'),
				'client_id'     => $token->get('client_id'),
				'client_secret' => $token->get('client_secret'),
				'scope'         => $token->get('scope')
			);
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
			$contents = array(
				'grant_type'    => 'password',
				'client_id'     => $token->get('client_id'),
				'client_secret' => $token->get('client_secret'),
				'username'      => $token->get('username'),
				'password'      => $token->get('password'),
				'scope'         => $token->get('scope'),
			);
			break;
		default:
			throw new \Exception(sprintf('Invalid type of grant "%s".', $grantType));
			break;
		}

		return $contents;
	}

	/**
	 * isValidToken 
	 * 
	 * @param Token $token 
	 * @access protected
	 * @return void
	 */
	protected function isValidToken(Token $token)
	{
		return ($token instanceof OAuth2TokenInterface);
	}
}

