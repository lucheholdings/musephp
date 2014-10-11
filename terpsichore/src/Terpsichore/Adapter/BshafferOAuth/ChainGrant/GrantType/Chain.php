<?php
namespace Terpsichore\Adapter\BshafferOAuth\ChainGrant\GrantType;

use OAuth2\ClientAssertionType\HttpBasic;
use OAuth2\GrantType\GrantTypeInterface;
use OAuth2\ResponseType\AccessTokenInterface;
use OAuth2\Storage\ClientCredentialsInterface as ClientCredentialsStorage;
use OAuth2\Storage\AccessTokenInterface as AccessTokenStorage;
use OAuth2\RequestInterface;
use OAuth2\ResponseInterface;

use Terpsichore\Adapter\BshafferOAuth\ChainGrant\Storage\ChainUserCredentials;
use Terpsichore\Adapter\BshafferOAuth\ChainGrant\Storage\ChainableClient;
use Terpsichore\Client\Auth\Provider as AuthenticationProvider;
use Terpsichore\Client\Auth\Token\PreAuthenticateToken;
use Terpsichore\Client\Auth\Provider\ProviderFactory as AuthenticationProviderFactory;

use Terpsichore\Client\Auth\OAuth;
use Terpsichore\Client\Auth\Provider\BasicProvider;

/**
 * Chain 
 *   "chain" grant
 * 
 * @uses GrantTypeInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Chain extends HttpBasic implements GrantTypeInterface 
{
	const REQUEST_AUTH_PROVIDER     = 'provider';
	const REQUEST_CLIENT_ID         = 'client_id';
	const REQUEST_OAUTH_TOKEN       = 'oauth_token';
	const REQUEST_OAUTH_SECRET      = 'oauth_secret';
	const REQUEST_USERNAME          = 'username';
	const REQUEST_PASSWORD          = 'password';

	private $userInfo;

	private $originalToken;

	private $userStorage;

	private $authProviderFactory;

	public function __construct(ClientCredentialsStorage $clientStorage, ChainUserCredentials $userStorage, AuthenticationProviderFactory $authProviderFactory, array $configs = array())
	{
		$this->userStorage = $userStorage;
		$this->authProviderFactory = $authProviderFactory;

		parent::__construct($clientStorage, $configs);
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

		// Get the original token provider if setted.
		$provider = null;

		$clientId = $this->getClientId();

		$client = $this->getClientStorage()->getClient($clientId);

		$providerName = $this->getProviderNameFromRequest($request); 

		$token = $this->createToken($client, $providerName);
		if(!$token) {
			$response->setError(400, 'invalid_provider', 'provider is not specified.');
		}

		$provider = $this->authProviderFactory->createForToken($token);
		if(!$provider) {
			$response->setError(400, 'invalid_grant', sprintf('Invalid provider specified: "%s" ', $providerName));
			return null;
		}

		$token = $this->updateTokenForProvider($provider, $token, $request);
		if(!$token->isAuthenticated()) {
			$response->setError(401, 'invalid_token', 'Invalid Token.');
			return null;
		}

		// Check the Client from the requestToken 
		$this->originalToken = $token;

		$userInfo = $this->getUserStorage()->getUserDetailsForChainToken($token);
        if (empty($userInfo)) {
            $response->setError(400, 'invalid_grant', 'Unable to retrieve user information');

            return null;
        }

        if (!isset($userInfo['user_id'])) {
            throw new \LogicException("you must set the user_id on the array returned by getUserDetails");
        }

		$this->userInfo = $userInfo;

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
		return $accessToken->createAccessToken($client_id, $user_id, $scope, false);
    }
    
    public function getOriginalToken()
    {
        return $this->originalToken;
    }
    
    public function setOriginalToken($originalToken)
    {
        $this->originalToken = $originalToken;
        return $this;
    }
    
    public function getClientStorage()
    {
        return $this->storage;
    }
    
    public function getUserStorage()
    {
        return $this->userStorage;
    }
    
    public function setUserStorage($userStorage)
    {
        $this->userStorage = $userStorage;
        return $this;
    }

	public function getConfigs()
	{
		return $this->config;
	}

	public function getDefaultProviderName()
	{
		return isset($configs['default_provider']) ? $configs['default_provider'] : null;
	}
    
    public function getAuthProviderFactory()
    {
        return $this->authProviderFactory;
    }
    
    public function setAuthProviderFactory($authProviderFactory)
    {
        $this->authProviderFactory = $authProviderFactory;
        return $this;
    }

	protected function createToken($client, $providerName)
	{
		// Create defaults by Client
		if($client instanceof ChainableClient) {
			$token = $client->createAuthenticateToken($providerName);
		} else {
			$token = new PreAuthenticateToken($providerName);
		}
		
		return $token;
	}

	protected function getProviderNameFromRequest($request)
	{
		$providerName = $request->request(self::REQUEST_AUTH_PROVIDER);

		if(!$providerName) {
			$providerName = $this->getDefaultProviderName();
			if(!$providerName) {
				return null;
			}
		}

		return $providerName;
	}

	protected function updateTokenForProvider(AuthenticationProvider $provider, PreAuthenticateToken $preToken, RequestInterface $request)
	{

		// get extra conditions depended by the authentication type
		if($provider instanceof OAuth\GenericOAuth1Provider) {
			$reqToken  = $request->request->get('oauth_token');
			$reqSecret = $request->request->get('oauth_token_secret');

			$token = new OAuth\Token\OAuth1UserToken($provider);
			
			$token
				->setToken($reqToken)
				->setTokenSecret($reqSecret)
				->setConsumerKey($preToken->get('client_id'))
				->setConsumerSecret($preToken->get('client_secret'))
			;
		} else if($provider instanceof OAuth\GenericOAuth2Provider) {
			$reqToken = $request->request->get('oauth_token');

			$token = new OAuth\Token\OAuth2UserToken($provider);
			$token
				->setToken($reqToken)
				->setClientId($preToken->get('client_id'))
			;
			if($preToken->has('client_secret')) {
				$token->setClientSecret($preToken->get('client_secret'));
			}
		} else if($provider instanceof BasicProvider) {
			$username = $requset->request->get('username');
			$password = $requset->request->get('password');

			$token = new BasicToken($provider, $user, $password);
		} else {
			throw new \Exception('Unknown authentication type is specified.');
		}

		// know chain grant need userinfo which related with the token.
		//if(!$provider->validateToken($token)) {
		//	throw new \RuntimeException('Token is invalid.');
		//}

		$token->setUser($provider->getAuthenticatedUser($token));

		return $token;
	}
}

