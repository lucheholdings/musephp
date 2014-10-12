<?php
namespace Terpsichore\Client\Auth\OAuth\Token;

use Terpsichore\Client\Auth\Token\PreAuthenticateToken;
/**
 * OAuth2Password
 * 
 * @uses PreAuthenticateToken
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class OAuth2Password extends PreAuthenticateToken 
{
	public function __construct($clientId, $clientSecret, $username, $password, array $attributes = array())
	{
		parent::__construct('oauth2', $attributes);
		
		// Set ClientId and Secret
		$this
			->set('client_id', $clientId)
			->set('client_secret', $clientSecret)
			->set('grant_type', 'password')
			->set('username', $username)
			->set('password', $password)
		;
	}
}

