<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ClientBundle\Security\Core\Authentication\Provider;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Clio\Component\Auth\OAuth2\Token\Provider\TokenProviderInterface,
	Clio\Component\Auth\OAuth2\Token\Provider\AuthorizationCodeGrantTokenProviderInterface;
/**
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class OAuth2AuthCodeAuthenticationProvider extends OAuth2AuthenticationProvider
{
	/**
	 * getOAuth2TokenByToken 
	 * 
	 * @param mixed $token 
	 * @access protected
	 * @return void
	 */
	protected function getOAuth2TokenByToken(TokenInterface $token)
	{
		// Use 
		return $this->getTokenProvider()->getTokenWithAuthorizationCode($token->getCredentials(), $this->getScopes());
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
		if(!$provider instanceof AuthorizationCodeGrantTokenProviderInterface) {
			throw new \InvalidArgumentException('OAuth2AuthCodeAuthenticationProvider requires AuthorizationCodeTokenProviderInterface as TokenProvider.');
		}

		return parent::setTokenProvider($provider);
	}
}

