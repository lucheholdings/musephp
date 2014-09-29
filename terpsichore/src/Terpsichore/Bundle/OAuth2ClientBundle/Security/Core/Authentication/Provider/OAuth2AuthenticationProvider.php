<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ClientBundle\Security\Core\Authentication\Provider;

use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

use Clio\Component\Auth\OAuth2\Exception as OAuth2Exception;
use Clio\Component\Auth\OAuth2\Token\Provider\TokenProviderInterface;
use Clio\Adapter\SymfonyBundles\OAuth2ClientBundle\Security\Core\User\OAuth2UserProviderInterface;
use Clio\Adapter\SymfonyBundles\OAuth2ClientBundle\Security\Core\User\OAuth2User;


use Clio\Adapter\SymfonyBundles\OAuth2ClientBundle\Security\Core\Authentication\Token\OAuth2Token;

use Clio\Component\Exception\ResourceNotFoundException;

use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
/**
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
abstract class OAuth2AuthenticationProvider implements AuthenticationProviderInterface
{
	/**
	 * tokenProvider 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $tokenProvider;

	/**
	 * userProvider 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $userProvider;

	/**
	 * logger 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $logger;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(TokenProviderInterface $tokenProvider, UserProviderInterface $userProvider)
	{
		$this->userProvider = $userProvider;

		$this->setTokenProvider($tokenProvider);
	}

	/**
	 * getTokenProvider 
	 * 
	 * @access public
	 * @return void
	 */
	public function getTokenProvider()
	{
		return $this->tokenProvider;
	}

	/**
	 * setTokenProvider 
	 * 
	 * @param TokenProviderInterface $provider 
	 * @access public
	 * @return void
	 */
	public function setTokenProvider(TokenProviderInterface $provider)
	{
		$this->tokenProvider = $provider;
		return $this;
	}

	/**
	 * authenticate 
	 * 
	 * @param TokenInterface $token 
	 * @access public
	 * @return void
	 */
	public function authenticate(TokenInterface $token)
	{
		if($token instanceof OAuth2Token)
			return $token;
		// authentication with grant password
		try {
			// We keep the code in credentials
			$accessToken = $this->getOAuth2TokenByToken($token);
		} catch(OAuth2Exception\AuthenticationException $ex) {
			// Failed to get access token
			throw new AuthenticationException($ex->getMessage(), 0, $ex);
		}
		
		if($accessToken) {
			$user = null;
			try {
				// If succeed to get token, then get UserInfo from UserProvider.
				// Causion: this is an optional. cause User already authenticated by token provider, UserProvider is additional.
				$userProvider = $this->getUserProvider();
				if($userProvider) {
					if($userProvider instanceof OAuth2UserProviderInterface) {
						// 
						$user = $userProvider->loadUserByAccessToken($accessToken);
					} else {
						$user = $userProvider->loadUserByUsername($token->getUsername()); 
					}
				}
			} catch(OAuth2Exception\AuthenticationException $ex) {
				throw new AuthenticationException('Failed to get User Information.', 0, $ex);
			}
			
			if($user) {
				$roles = array_unique(array_merge(array('ROLE_USER'), $user->getRoles()));
				// Create new Authenticated UserToken w/ Username and AccessToken
				$authenticatedToken = new OAuth2Token($user, $accessToken, $roles);
				return $authenticatedToken;
			}
		}

		throw new AuthenticationException('Failed to authenticate.');
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
		return $token instanceof OAuth2Token;
	}
    
	/**
	 * getUserProvider 
	 * 
	 * @access public
	 * @return void
	 */
	public function getUserProvider()
	{
		return $this->userProvider;
	}

    /**
     * Get logger.
     *
     * @access public
     * @return logger
     */
    public function getLogger()
    {
        return $this->logger;
    }
    
    /**
     * Set logger.
     *
     * @access public
     * @param logger the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
        return $this;
    }

	abstract protected function getOAuth2TokenByToken(TokenInterface $token);

}

