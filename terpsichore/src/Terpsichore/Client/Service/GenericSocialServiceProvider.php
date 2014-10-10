<?php
namespace Terpsichore\Client\Service;

use Terpsichore\Client\Auth\Provider as AuthenticationProvider;
use Terpsichore\Client\Auth\UserProvider;
use Terpsichore\Client\Auth\Token\UserToken;

/**
 * GenericSocialServiceProvider 
 * 
 * @uses GenericClientServiceProvider
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class GenericSocialServiceProvider extends GenericClientServiceProvider 
{
	/**
	 * _userProvider 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $_userProvider;

	/**
	 * getAuthenticatedUserProvider 
	 * 
	 * @access public
	 * @return void
	 */
	public function getAuthenticatedUserProvider()
	{
		return $this->_userProvider;
	}

	/**
	 * setAuthenticatedUserProvider 
	 * 
	 * @param UserProvider $userProvider 
	 * @access public
	 * @return void
	 */
	public function setAuthenticatedUserProvider(UserProvider $userProvider, $alias = 'userinfo')
	{
		$this->_userProvider = $userProvider;
		
		if($alias) {
			$this->setService($alias, $userProvider);
		}

		return $this;
	}

	/**
	 * getAuthenticatedUser 
	 * 
	 * @access public
	 * @return void
	 */
	public function getAuthenticatedUser()
	{
		$token = $this->getConnection()->getSecuredConnection()->getToken();

		if($token instanceof UserToken) {
			return $token->getUser();
		} else if($userProvider = $this->getAuthenticatedUserProvider()) {
			// Escalate the token
			$user = $this->getAuthenticatedUserProvider()->getAuthenticatedUser();
			$this->getConnection()->getSecuredConnection()->setToken(new UserToken($token, $user)); 

			return $user;
		} else {
			throw new \RuntimeException(sprintf('Service "%s" cannot provide authenticaed user without AuthenticatedUserProvider.', $this->getName()));
		}
	}
}
