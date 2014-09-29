<?php
namespace HighSpirit\Service\Auth\Bundle\ServerBundle\GrantType;

use OAuth2\GrantType\UserCredentials;
use OAuth2\GrantType\GrantTypeInterface;
use OAuth2\Storage\UserCredentialsInterface;
use OAuth2\ResponseType\AccessTokenInterface;
use OAuth2\RequestInterface;
use OAuth2\ResponseInterface;

use HighSpirit\Service\Auth\Bundle\ServerBundle\Storage\SocialUserCredentialsInterface;
use HighSpirit\Service\Auth\Bundle\ServerBundle\Social\Resolver\CredentialResolver;

/**
 * InheritCredentials
 *   "inherit_credentials" is to use other OAuth services as the AuthenticationProvider. 
 *   If client provider "twitter token," then InheritCredential validate the token w/ twitter.
 *   And iff the token is validated, then return self oauth2 token to client.
 * 
 *  Http Header:
 *    - Authorization: OAuth xxxx or Bearer xxxx
 *    - (Authorization-Provider: "twitter", "google_plus" or some other)
 *  Http Body:
 *    - client_id:   Client ID which This Auth Service providers.
 *    - (authrozization_provider: "twitter", "google_plus" or some other.)
 * 
 * @uses GrantTypeInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class InheritCredentials implements GrantTypeInterface
{
	/**
	 * userStorage 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $userStorage;

	/**
	 * clientStorage 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $clientStorage;

	private $userInfo;

	private $credentialInfoResolver;

	public function __construct(UserCredentialsInterface $userStorage, ClientCredentialsInterface $clientStorage, CredentialInfoResolver $credentialInfoResolver)
	{
		$this->userStorage = $userStorage;
		$this->clientStorage = $clientStorage;

		$this->credentialInfoResolver = $credentialInfoResolver;
	}

	public function getQuerystringIdentifier()
	{
		return 'proxy_credentials';
	}

    public function validateRequest(RequestInterface $request, ResponseInterface $response)
	{
		$endpoint = null;
		$token    = null;
		$clientId = null;

		if($request->headers->has('Authorization')) {
			$token = $request->headers->get('Authorization');
		} else if($request->request->has('authorization')) {
			$token = $request->request->get('authorization');
		} else {
			$response->setError(400, 'invalid_request', 'Failed to get Authorization request.');
			return null;
		}

		if(!($endpoint = $request->request('endpoint'))) {
			$response->setError(400, 'invalid_request', 'Missing parameters: "endpoint" required.');
			return null;
		}

		// Get Social UserId from AccessToken
		$authenticated = new AuthenticatedByClientToken();
		$authenticated->setAuthorizationToken($token);

		// 
		$authenticated->setClientId($this->getClientStorage()->getMappedIdFor($endpoint));

		$credentialInfo = $this->getCredentialInfoResolver()->resolveByAuthenticated($authenticated, $endpoint);

		// Validate ConsumerId for this client_id or not.
		$this->getClientStorage()->checkClientProxyCredentials($credentialInfo->getClientId(), $credentialInfo->getProvider());

		// Check the access_token is for UserCredentials 
		if($credentialInfo->isUserCredential()) {
			// Get Service Related UserCredentials from UserStorage 
			$userInfo = $this->getUserStorage()->getUserDetails($credentialInfo->getUserId(), $endpoint);
        	if (empty($userInfo)) {
        	    $response->setError(400, 'invalid_grant', 'Unable to retrieve user information');
        	    return null;
        	}

        	if (!isset($userInfo['user_id'])) {
        	    throw new \LogicException("you must set the user_id on the array returned by getUserDetailsForService");
        	}

        	$this->userInfo = $userInfo;
		} else {
			$response->setError(400, 'invalid_grant', sprintf('Unable to retrieve user information from Social Service "%s"', $endpoint));
		}

		return true;
	}

    public function getUserId()
    {
        return $this->userInfo['user_id'];
    }

    public function getScope()
    {
        return isset($this->userInfo['scope']) ? $this->userInfo['scope'] : null;
    }
    
    public function getCredentialInfoResolver()
    {
        return $this->credentialInfoResolver;
    }
    
    public function setCredentialInfoResolver($credentialInfoResolver)
    {
        $this->credentialInfoResolver = $credentialInfoResolver;
        return $this;
    }

	public function getUserStorage()
	{
		return $this->userStorage;
	}

	public function getClientStorage()
	{
		return $this->clientStorage;
	}
}

