<?php
namespace Terpsichore\Server\Auth\OAuth\Token;

/**
 * TokenInfo 
 * 
 * @uses ServerToken
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TokenInfo extends ServerToken 
{
	/**
	 * fromArray 
	 * 
	 * @param array $params 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function fromArray(array $params)
	{
		$tokenInfo = new self();

		$tokenInfo->setClientId($params['audience']);
		$tokenInfo->setScopes(isset($params['scopes']) ? $params['scopes'] : array());
		$tokenInfo->setExpiresAt(new \DateTime('@' . time() + $params['expires_in']));

		return $tokenInfo;
	}

	/**
	 * createClientToken 
	 * 
	 * @param mixed $accessToken 
	 * @access public
	 * @return void
	 */
	public function createClientToken()
	{
		$token = new ClientToken();

		$token->setAccessToken($this->getToken());
		$token->setScopes($this->getScopes());
		$token->setExpiresIn($this->getExpiresIn());

		return $token;
	}
}

