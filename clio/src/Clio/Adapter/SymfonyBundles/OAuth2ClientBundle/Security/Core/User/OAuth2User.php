<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ClientBundle\Security\Core\User;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class OAuth2User implements AdvancedUserInterface
{
	/**
	 * username 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $username;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct($username)
	{
		$this->username = $username;
	}


	/**
	 * getRoles 
	 * 
	 * @access public
	 * @return void
	 */
	public function getRoles()
	{
		return array('ROLE_USER');
	}

	/**
	 * getPassword 
	 * 
	 * @access public
	 * @return void
	 */
	public function getPassword()
	{
		return null;
	}

	/**
	 * getSalt 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSalt()
	{
		return null;
	}

	/**
	 * getUsername 
	 * 
	 * @access public
	 * @return void
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * eraseCredentials 
	 * 
	 * @access public
	 * @return void
	 */
	public function eraseCredentials()
	{
	}

    /**
     * {@inheritdoc}
     */
    public function isAccountNonExpired()
    {
		return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isAccountNonLocked()
    {
		return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isCredentialsNonExpired()
    {
		return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isEnabled()
    {
		return true;
    }
}

