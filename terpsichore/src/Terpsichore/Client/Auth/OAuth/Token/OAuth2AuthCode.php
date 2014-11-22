<?php
namespace Terpsichore\Client\Auth\OAuth\Token;

use Terpsichore\Client\Auth\Token\PreAuthenticateToken;
/**
 * OAuth2AuthCode
 * 
 * @uses PreAuthenticateToken
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class OAuth2AuthCode extends PreAuthenticateToken 
{
	public function __construct($clientId, $clientSecret, $code = null, array $attributes = array())
	{
		parent::__construct('oauth2', $attributes);
		
		// Set ClientId and Secret, and code
		$this
			->set('client_id', $clientId)
			->set('client_secret', $clientSecret)
			->set('code', $code)
			->set('grant_type', 'authorization_code')
		;
	}
}

