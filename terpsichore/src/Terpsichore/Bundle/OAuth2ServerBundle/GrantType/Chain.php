<?php
namespace Terpsichore\Bundle\OAuth2ServerBundle\GrantType;

use OAuth2\ClientAssertionType\HttpBasic;
use OAuth2\GrantType\GrantTypeInterface;
use OAuth2\ResponseType\AccessTokenInterface;
use OAuth2\Storage\ClientCredentialsInterface as ClientCredentialsStorage;
use OAuth2\Storage\AccessTokenInterface as AccessTokenStorage;
use OAuth2\RequestInterface;
use OAuth2\ResponseInterface;

/**
 * Chain 
 * 
 * @uses GrantTypeInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Chain extends HttpBasic implements GrantTypeInterface 
{
	private $accessTokenStorage;

	private $userInfo;

	private $originalToken;

	public function __construct(ClientCredentialsStorage $storage, AccessTokenStorage $accessTokenStorage, array $config = array())
	{
        $config['allow_public_clients'] = false;

		$this->accessTokenStorage = $accessTokenStorage;
        parent::__construct($storage, $config);
	}

	public function getQuerystringIdentifier()
	{
		return 'chain';
	}

    public function validateRequest(RequestInterface $request, ResponseInterface $response)
	{
		if(!parent::validateRequest($request, $response)) {
			return false;		
		}

		$originalToken = null;
		if(!($originalToken =  $request->request('access_token'))) {
			$response->setError(400, 'invalid_request', 'Missing parameters: "access_token" required');

			return null;
		}
		
		// Get chained access token
		$originalToken = $this->getAccessTokenStorage()->getAccessToken($originalToken);
		if(!$originalToken) {
			$response->setError(406, 'invalid_token', 'Invalid access token to chain.');
			return null;
		}

		// Check the Client from the requestToken 
		$this->originalToken = $originalToken;

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

    /**
     * Get accessTokenStorage.
     *
     * @access public
     * @return accessTokenStorage
     */
    public function getAccessTokenStorage()
    {
        return $this->accessTokenStorage;
    }
    
    /**
     * Set accessTokenStorage.
     *
     * @access public
     * @param accessTokenStorage the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setAccessTokenStorage($accessTokenStorage)
    {
        $this->accessTokenStorage = $accessTokenStorage;
        return $this;
    }

    private function loadClientData()
    {
        if (!$this->clientData) {
            $this->clientData = $this->storage->getClientDetails($this->getClientId());
        }
    }

    /**
     * createAccessToken 
     * 
     * @param AccessTokenInterface $accessToken 
     * @param mixed $client_id 
     * @param mixed $user_id 
     * @param mixed $scope 
     * @access public
     * @return void
     */
    public function createAccessToken(AccessTokenInterface $accessToken, $client_id, $user_id, $scope)
    {
        $includeRefreshToken = false;

		$originalToken = $this->getOriginalToken();


		$ttl = $originalToken['expires'] - time();
		$accessToken->setConfig('access_lifetime', $ttl);
		// Create ChainedToken
        $chainedToken = $accessToken->createAccessToken($client_id, $originalToken['user_id'], $originalToken['scope'], $includeRefreshToken);

		return $chainedToken;
    }
    
    /**
     * Get originalToken.
     *
     * @access public
     * @return originalToken
     */
    public function getOriginalToken()
    {
        return $this->originalToken;
    }
    
    /**
     * Set originalToken.
     *
     * @access public
     * @param originalToken the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setOriginalToken($originalToken)
    {
        $this->originalToken = $originalToken;
        return $this;
    }
}

