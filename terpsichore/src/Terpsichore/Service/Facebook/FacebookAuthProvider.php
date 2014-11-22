<?php
namespace Terpsichore\Service\Facebook;

use Terpsichore\Client\Auth\OAuth\GenericOAuth2Provider;
use Terpsichore\Client\Auth\Token;
use Terpsichore\Client\Exception\AuthenticationException;
use Terpsichore\Client\Request;

class FacebookAuthProvider extends GenericOAuth2Provider 
{
	const TOKEN_EXPIRES_IN = 'expires';
	
	public function request(Request $request)
	{
		$response = parent::request($request);

		// Facebook response as text/plain, thus if response is string, forcely parse the response as x-www-form-urlencoded
		if(is_string($response)) {
			$pairs = array();
			foreach(explode('&', $response) as $pair) {
				list($key, $value) = explode('=', $pair);

				$pairs[rawurldecode($key)] = rawurldecode($value);
			}

			return $pairs;
		}

		return $response;
	}

	protected function doAuthenticate(Token $token)
	{
		try {
			$authenticated = parent::doAuthenticate($token);
		} catch(AuthenticationException $ex) {
			$headers = $ex->getPrevious()->getResponseHeaders();
			$errorMessage = $headers['WWW-Authenticate'][0];

			throw new AuthenticationException($this, $ex->getRequest(), $ex->getResponse(), $errorMessage, 0, $ex);
		}

		return $authenticated;
	}

	public function getName()
	{
		return 'facebook.oauth';
	}
}

