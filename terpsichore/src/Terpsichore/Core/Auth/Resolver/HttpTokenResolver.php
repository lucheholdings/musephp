<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Core\Auth\Resolver;

use Terpsichore\Core\Auth\Token;

class HttpTokenResolver 
{
	public function resolveAuthorizationHeaders(Token $token)
	{
		$headers = array();

		switch(true) {
		case ($token instanceof OAuth\Token\OAuth1Token):

			$headers = array(
				'Authorization' => 'OAuth '. OAuthUtils::generateToken($token),
			);
			break;
		case ($token instanceof OAuth\Token\OAuth2Token):

			$headers = array(
				'Authorization' => 'Bearer '. $token->getToken(),
			);
			break;
		case ($token instanceof Token\BasicToken):
			$headers = array(
				'Authorization' => 'Basic ' . base64_encode($token->getUsername() . ':' . $token->getPassword())
			);
			break;
		default:
			break;
		}

		return $headers;
	}

	public function resolveTokenFromAuthorizationHeader($header)
	{
		$matches = array();
		if(!preg_match('/^(?P<type>\w+)\s(?P<token>.*)$/', $header, $matches)) {
			throw new \InvalidArgumentException(sprintf('Failed to parse Authorization header.'));
		}

		switch(strtolower($matches['type'])) {
		case 'basic':
			new BasicToken();
			break;
		case 'oauth':
			new OAuth\Token\OAuth1Token();
			break;
		case 'bearer':
			new OAuth\Token\OAuth2BearerToken();
			break;
		}

		return $token;
	}
}

