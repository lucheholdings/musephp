<?php
namespace Terpsichore\Client\Auth\OAuth;

use Terpsichore\Client\Auth\Token;
use Terpsichore\Client\Auth\OAuth\OAuth2Token as OAuth2TokenInterface;
use Terpsichore\Client\Auth\OAuth\Token\OAuth2Token;
use Terpsichore\Client\Auth\OAuth\Handler\OAuth2AuthCodeHandler;
use Terpsichore\Client\Auth\OAuth\Token\OAuth2AuthCode;

use Terpsichore\Client\Exception\TransferException;
use Terpsichore\Client\Exception\AuthenticationException;
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
	const TOKEN_ACCESS_TOKEN = 'access_token';
	const TOKEN_TYPE             = 'token_type';
	const TOKEN_REFRESH_TOKEN    = 'refresh_token';
	const TOKEN_EXPIRES_IN       = 'expires';
	const TOKEN_SCOPE            = 'scope';
	const TOKEN_GRANT_TYPE       = 'grant_type';

	const GRANT_CLIENT_CREDENTIALS = 'client_credentials';
	const GRANT_PASSWORD           = 'password';
	const GRANT_AUTHORIZATION_CODE = 'authorization_code';

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
			->set(static::TOKEN_GRANT_TYPE, static::GRANT_CLIENT_CREDENTIALS)
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
			->set(static::TOKEN_GRANT_TYPE, static::GRANT_PASSWORD)
		;

		return $this->doAuthenticate($token);
	}

	/**
	 * authCode 
	 *   if token has "code", then goto token process
	 *   otherwise, goto authProvider login form
	 * @access public
	 * @return void
	 */
	public function authCode(Token $reqToken)
	{
		$token = clone $reqToken;
		$token
			->set(static::TOKEN_GRANT_TYPE, static::GRANT_AUTHORIZATION_CODE)
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
		$request = $this->createHttpRequest(
				$this->getUri(), 
				$this->getMethod(), 
				// Body
				$this->createRequestBodyFromToken($token)
			);
		try {
			$response = $this->request($request);
		} catch(TransferException $ex) {
			throw new AuthenticationException($this, $ex->getRequest(), $ex->getResponse(), $ex->getMessage(), 0, $ex);
		}

		if(!$response) {
			throw new AuthenticationException($this, $request, $response, 'Failed to authenticate.');
		}

		// Create Token from the response
		$token = new OAuth2Token($this);
		
		$token
			->setToken($response[static::TOKEN_ACCESS_TOKEN])
			->setExpiresIn($response[static::TOKEN_EXPIRES_IN])
		;
		if(isset($response[static::TOKEN_TYPE])) {
			$token->setType($repsonse[static::TOKEN_TYPE]);
		}
		if(isset($response[static::TOKEN_SCOPE])) {
			$token->setScopes($repsonse[static::TOKEN_SCOPE]);
		}
		if(isset($response[static::TOKEN_REFRESH_TOKEN])) {
			$token
				->setRefreshToken($response[static::TOKEN_REFRESH_TOKEN])
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
		$grantType = $token->get(static::TOKEN_GRANT_TYPE);
		switch($grantType) {
		case static::GRANT_AUTHORIZATION_CODE:
			$contents = array(
				'code'          => $token->get('code'),
				'redirect_uri'  => $token->get('redirect_uri'),
				'client_id'     => $token->get('client_id'),
				'client_secret' => $token->get('client_secret'),
				//static::TOKEN_SCOPE         => $token->get(static::TOKEN_SCOPE),
				//'state'         => $token->get('state')
			);
			break;
		case static::GRANT_CLIENT_CREDENTIALS:
			$contents = array(
				'grant_type'    => static::GRANT_CLIENT_CREDENTIALS,
				'client_id'     => $token->get('client_id'),
				'client_secret' => $token->get('client_secret'),
				static::TOKEN_SCOPE         => $token->get(static::TOKEN_SCOPE),
			);
			break;
		case static::GRANT_PASSWORD:
			$contents = array(
				'grant_type'    => static::GRANT_PASSWORD,
				'client_id'     => $token->get('client_id'),
				'client_secret' => $token->get('client_secret'),
				'username'      => $token->get('username'),
				'password'      => $token->get('password'),
				static::TOKEN_SCOPE         => $token->get(static::TOKEN_SCOPE),
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

	public function createAuthCodeHandler(OAuth2AuthCode $token, $entryPoint, array $params = array())
	{
		$token->set('redirect_uri', $entryPoint);
		if(isset($params[static::TOKEN_SCOPE])) 
			$token->set('scope', $params['scope']);
		return new OAuth2AuthCodeHandler($this, $token, array(
			'entry_point' => $this->getOption('login_path'),
			'query' => array_merge(
				$params, 
				array(
					'redirect_uri' => $entryPoint, 
				)
			),
		));
	}
}

