<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ClientBundle\Security\Core\User;

# @use Symfony Security Component
use Symfony\Component\Security\Core\Exception\UnsupportedUserException,
	Symfony\Component\Security\Core\Exception\UsernameNotFoundException,
	Symfony\Component\Security\Core\User\UserInterface 
;
# @use ClioComponentOAuth2 extensions components
use Clio\Component\Auth\OAuth2\User\Provider\UserProviderInterface;
use Clio\Component\Auth\OAuth2\Token\ClientTokenInterface;
/**
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class OAuth2ProxyUserProvider
  implements
    OAuth2UserProviderInterface
{
	/**
	 * provider 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $provider;

	/**
	 * __construct 
	 * 
	 * @param UserProviderInterface $provider 
	 * @access public
	 * @return void
	 */
	public function __construct(UserProviderInterface $provider)
	{
		$this->provider = $provider;
	}

	/**
	 * getSource 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSource()
	{
		return $this->provider;
	}

    /**
     * loadUserByUsername 
     * 
     * @param mixed $username 
     * @access public
     * @return void
     */
    public function loadUserByUsername($username)
	{
		throw new \Exception('OAuth2 only support loadUserByAccessToken, loadUserByUsername is not acceptable.');
	}

	/**
	 * loadUserByAccessToken 
	 * 
	 * @param ClientTokenInterface $token 
	 * @access public
	 * @return void
	 */
	public function loadUserByAccessToken(ClientTokenInterface $token)
	{
		$user = $this->getSource()->findUserByAccessToken($token);

		return $user;
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
		throw new \Exception('OAuth2 is not support refreshUser.');
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
		return true;
	}
}

