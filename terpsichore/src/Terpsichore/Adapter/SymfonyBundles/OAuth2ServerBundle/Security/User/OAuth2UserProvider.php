<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Security\User;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

use Terpsichore\Core\OAuth2\Exception as OAuth2Exceptions;
/**
 * OAuth2UserProvider 
 *   Return Dummy User 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class OAuth2UserProvider implements 
    UserProviderInterface,
	OAuth2UserProviderInterface
{
	/**
	 * userinfoProvider 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $userinfoProvider;

	/**
	 * __construct 
	 * 
	 * @param UserinfoProvider $userinfoProvider 
	 * @access public
	 * @return void
	 */
	public function __construct(UserinfoProvider $userinfoProvider = null)
	{
		$this->userinfoProvider = $userinfoProvider;
	}

	/**
	 * loadUserById 
	 * 
	 * @param mixed $id 
	 * @access public
	 * @return void
	 */
	public function loadUserById($id)
	{
		return new OAuth2User($id);
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
		return new OAuth2User();
	}

	/**
	 * loadUserByAccessToken 
	 * 
	 * @param mixed $token 
	 * @access public
	 * @return void
	 */
	public function loadUserByAccessToken($token)
	{
		if($this->getUserinfoProvider()) {
			try {
				$id = $this->getUserinfoProvider()->getUserId($token);
			
				if($id) {
					return new OAuth2User($id);
				}
			} catch(\Guzzle\Http\Exception\ServerErrorResponseException $ex) {
				throw new OAuth2Exceptions\InvalidTokenException('specify valid access token', 0, $ex);
			}
		}

		return null;
	}

	public function loadUserBySocialAccount($id, $type)
	{
		// Return Dummy User
		return new OAuth2User();
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
		return $user;
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
    
    /**
     * getUserinfoProvider 
     * 
     * @access public
     * @return void
     */
    public function getUserinfoProvider()
    {
        return $this->userinfoProvider;
    }
    
    /**
     * setUserinfoProvider 
     * 
     * @param mixed $userinfoProvider 
     * @access public
     * @return void
     */
    public function setUserinfoProvider($userinfoProvider)
    {
        $this->userinfoProvider = $userinfoProvider;
        return $this;
    }
}

