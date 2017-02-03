<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ClientBundle\Security\Core\Authentication\Provider;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Clio\Component\Auth\OAuth2\Token\Provider\TokenProviderInterface,
	Clio\Component\Auth\OAuth2\Token\Provider\PasswordGrantTokenProviderInterface;

use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
/**
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class OAuth2PasswordGrantAuthenticationProvider extends OAuth2AuthenticationProvider
{
	/**
	 * getOAuth2TokenByToken 
	 * 
	 * @param TokenInterface $token 
	 * @access protected
	 * @return void
	 */
	protected function getOAuth2TokenByToken(TokenInterface $token)
	{
		return $this->getTokenProvider()->getTokenWithPasswordGrant($token->getUsername(), $token->getCredentials());
	}

	/**
	 * setAccessTokenProvider 
	 * 
	 * @param TokenProviderInterface $provider 
	 * @access public
	 * @return void
	 */
	public function setTokenProvider(TokenProviderInterface $provider)
	{
		if(!$provider instanceof PasswordGrantTokenProviderInterface) {
			throw new \InvalidArgumentException('OAuth2AuthCodeAuthenticationProvider requires AuthorizationCodeTokenProviderInterface as TokenProvider.');
		}

		return parent::setTokenProvider($provider);
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
		return (($token instanceof UsernamePasswordToken) || ($token instanceof OAuth2Token));
	}
}

