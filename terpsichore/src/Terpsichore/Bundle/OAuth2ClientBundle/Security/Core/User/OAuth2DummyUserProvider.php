<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ClientBundle\Security\Core\User;

# @use Symfony Security Component
use Symfony\Component\Security\Core\Exception\UnsupportedUserException,
	Symfony\Component\Security\Core\Exception\UsernameNotFoundException,
	Symfony\Component\Security\Core\User\UserInterface 
;
use Symfony\Component\Security\Core\User\UserProviderInterface as SecurityUserProviderInterface;
# @use ClioComponentOAuth2 extensions components
use Clio\Component\Auth\OAuth2\User\Provider\UserProviderInterface;

/**
 * OAuth2DummyUserProvider 
 * 
 * @uses SecurityUserProviderInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class OAuth2DummyUserProvider implements SecurityUserProviderInterface
{

    /**
     * loadUserByUsername 
     * 
     * @param mixed $username 
     * @access public
     * @return void
     */
    public function loadUserByUsername($username)
	{
		return new OAuth2User($username);
	}

    /**
     * refreshUser 
     * 
     * @param UserInterface $user 
     * @access public
     * @return void
     */
    public function refreshUser(UserInterface $user)
	{
		return $this->loadUserByUsername($user->getUsername());
	}

    /**
     * supportsClass 
     * 
     * @param mixed $class 
     * @access public
     * @return void
     */
    public function supportsClass($class)
	{
		return ($class instanceof OAuth2User);
	}
}

