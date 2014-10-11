<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Security\Authentication\Provider;

use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Security\Authentication\Token\OAuth2SecurityToken;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use OAuth2\Server;
use OAuth2\OAuth2ServerException;
use Clio\Component\Auth\OAuth2\Token\ChainedToken;

use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Security\Role\ScopeRoleMap;
use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Security\User\OAuth2UserProviderInterface;

/**
 * OAuth2AuthenticationProvider 
 * 
 * @uses AuthenticationProviderInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class OAuth2AuthenticationProvider implements AuthenticationProviderInterface
{
    /**
     * userProvider 
     * 
     * @var mixed
     * @access protected
     */
    protected $userProvider;

	/**
	 * scopeRoleMap 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $scopeRoleMap;

    /**
     * @param \Symfony\Component\Security\Core\User\UserProviderInterface $userProvider      The user provider.
     */
    public function __construct(UserProviderInterface $userProvider = null, ScopeRoleMap $scopeRoleMap = null)
    {
        $this->userProvider  = $userProvider;
		$this->scopeRoleMap  = $scopeRoleMap;
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate(TokenInterface $token)
    {
		$user = null;

        if (!$this->supports($token)) {
            return null;
        } else if($token->isAuthenticated()) {
			return $token;
		}

        try {
			// Get OAuth2 Token 
            $oauthToken = $token->getServerToken();

			// Server or Chained Token 
			if($oauthToken) {
				$roles = array();

				// Convert scopes to roles
				{
                	$scopes  = $oauthToken->getScopes();
					// Convert Scope to Role
                	if (!empty($scopes)) {
						$scopeRoleMap = $this->getScopeRoleMap();
						if($scopeRoleMap) {
                	    	foreach ($scopes as $scope) {
								if($scopeRoleMap->hasScope($scope)) {
									$roles[] = $scopeRoleMap->getRole($scope);
								}
                	    	}
						}
                	}
				}

				// If UserId is related, then UserAuthenticated by OAuth2
				// Otherwise, ClientCredentials
				try {
					$user = null;
					$userProvider = $this->getUserProvider();
					if($userId = $oauthToken->getUserId()) {
						// Use this userid
						if($userProvider) {
							$user = $userProvider->loadUserById($userId);
							if($user) {
								foreach($user->getRoles() as $role) {
									$roles[] = $role;
								}
							}
						} else {
							$user = $userId;
						}
					} else if($userProvider && ($userProvider instanceof OAuth2UserProviderInterface)) {
						// Now we try
						$user = $userProvider->loadUserByAccessToken($oauthToken->getToken());
						if($user) {
							foreach($user->getRoles() as $role) {
								$roles[] = $role;
							}
						} 
					} 
				} catch(\Exception $ex) {
					throw $ex;
				}
			
				if($user) {
					$roles[] = 'ROLE_USER';
				} else if($oauthToken->getClientId()) {
					$roles[] = 'ROLE_CLIENT';
				}

				//
                $token = new OAuth2SecurityToken(array_unique($roles));
                $token->setAuthenticated(true);
                $token->setServerToken($oauthToken);

				if($user) {
					$token->setUser($user);
				}
				
                return $token;
            }
			
			// AccessToken is not given.
			// So throw the AuthenticationException, and enter to the authentication flow
        } catch (OAuth2ServerException $e) {
            throw new AuthenticationException('OAuth2 authentication failed', null, 0, $e);
        }

        throw new AuthenticationException('OAuth2 authentication failed');
    }

    /**
     * supports 
     * 
     * @param TokenInterface $token 
     * @access public
     * @return void
     */
    public function supports(TokenInterface $token)
    {
        return $token instanceof OAuth2SecurityToken;
    }

	/**
	 * getDefaultUserRoles 
	 * 
	 * @access public
	 * @return void
	 */
	public function getDefaultUserRoles()
	{
		return array('ROLE_USER');
	}

	/**
	 * getDefaultClientRoles 
	 * 
	 * @access public
	 * @return void
	 */
	public function getDefaultClientRoles()
	{
		return array('ROLE_CLIENT');
	}
    
    /**
     * Get scopeRoleMap.
     *
     * @access public
     * @return scopeRoleMap
     */
    public function getScopeRoleMap()
    {
        return $this->scopeRoleMap;
    }
    
    /**
     * Set scopeRoleMap.
     *
     * @access public
     * @param scopeRoleMap the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setScopeRoleMap($scopeRoleMap)
    {
        $this->scopeRoleMap = $scopeRoleMap;
        return $this;
    }
    
    /**
     * Get userProvider.
     *
     * @access public
     * @return userProvider
     */
    public function getUserProvider()
    {
        return $this->userProvider;
    }
    
    /**
     * Set userProvider.
     *
     * @access public
     * @param userProvider the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setUserProvider($userProvider)
    {
        $this->userProvider = $userProvider;
        return $this;
    }
}
