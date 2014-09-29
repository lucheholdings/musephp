<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ClientBundle\Security\Core\Authentication\Token;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;
use Clio\Component\Auth\OAuth2\Token\ClientTokenAwareInterface;

/**
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class OAuth2Token extends AbstractToken
  implements
    ClientTokenAwareInterface
{
	/**
	 * user 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $user;

	/**
	 * oauthToken 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $oauthToken;

	/**
	 * __construct 
	 * 
	 * @param mixed $user 
	 * @param mixed $token OAuth Token 
	 * @param array $roles 
	 * @access public
	 * @return void
	 */
	public function __construct($user, $token, $roles = array())
	{
		parent::__construct($roles);

		$this->setUser($user);
		$this->oauthToken = $token;

		// 
		$this->setAuthenticated(true);
	}

	/**
	 * getOAuthToken 
	 * 
	 * @access public
	 * @return void
	 */
	public function getOAuthToken()
	{
		return $this->oauthToken;
	}

	/**
	 * getCredentials 
	 * 
	 * @access public
	 * @return void
	 */
	public function getCredentials()
	{
		return array();
	}

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
		$this->setAttributes(array_merge($this->getAttributes(), array('oauthToken' => $this->oauthToken)));
		return parent::serialize();
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
		parent::unserialize($serialized);

		$attrs = $this->getAttributes();
		$this->oauthToken = $attrs['oauthToken'];
    }

}

