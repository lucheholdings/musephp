<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Core\Auth\Resolver;

use Terpsichore\Core\Client\HttpRequest;
use Terpsichore\Core\Auth\OAuth\OAuthUtil;

class HttpAuthenticationResolver 
{
	public function resolveHeaders(HttpRequest $request)
	{
		$token = $request->getSecurityToken();

		switch($token->getName()) {
		case 'oauth1':
			$oauthParams = array(
				'oauth_consumer_key' => $token->getClientId(),
				'oauth_timestamp' => $token->getTimestamp(),
				'oauth_nonce' => $token->getNonce(),
				'oauth_version' => '1.0',
				'oauth_signature_method' => $token->getSignatureMethod(),
				'oauth_token' => $token->getToken(),
				'oauth_signature' => OAuthUtil::signRequest($request, $token),
			);
			foreach ($oauthParams as $key => $value) {
				$oauthParams[$key] = $key . '="' . rawurlencode($value) . '"';
			}
			ksort($oauthParams);

			if ($token->hasRealm()) {
				array_unshift($oauthParams, 'realm="' . rawurlencode($token->getRealm()) . '"');
			}

			$request->setHeader('Authorization', 'OAuth ' . implode(', ', $oauthParams));

			break;
		case 'oauth2':
			$request->setHeader('Authorization', $this->convertAuthrorizationHeaderCase($token->getType()) . ' ' . $token->getToken());
			break;
		case 'basic':
			$request->setHeader('Authorization', 'Basic ' . base64_encode($token->getUsername().':'. $token->getPassword()));
			break;
		case 'digest':
		case 'wsse':
		default:
			break;
		}

		return $request;
	}

	public function resolveBody(HttpRequest $request)
	{
		return $request;
	}

	public function convertAuthrorizationHeaderCase($str)
	{
		switch(strtolower($str)) {
		case 'basic':
		case 'bearer':
			$str = ucfirst($str);
			break;
		case 'oauth':
			$str = 'OAuth';
			break;
		default:
			break;
		}

		return $str;
	}
}

