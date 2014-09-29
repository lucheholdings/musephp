<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Service\Facebook;

class Facebook extends OAuth2Service 
{
	function init()
	{
		$this->('get_token', '/token');
	}

	public function authenticate(Token $token)
	{

	}

	public function getAuthenticatedUserInfo(Token $token)
	{
		if(!$token->isAuthenticated()) {
			throw new \RuntimeException('Token is not authenticated.');
		}

		if($token->hasUser()) {
			return $token->getUser();
		} else {
			$response = $this->client->getAuthenticatedUserInfo();

			// Convert response to User
			$user = $this->convertToUser($response);
			$token->setUser($user);
		}

		return $user;
	}
}

