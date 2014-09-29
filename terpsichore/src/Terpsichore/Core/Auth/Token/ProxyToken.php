<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Core\Auth\Token;

use Terpsichore\Core\Auth\Token as TokenInterface;

/**
 * ProxyToken 
 * 
 * @uses Token
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ProxyToken extends Token 
{
	/**
	 * token 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $token;

	/**
	 * __construct 
	 * 
	 * @param TokenInterface $token 
	 * @access public
	 * @return void
	 */
	public function __construct(TokenInterface $token)
	{
		$this->token = $token;
	}
    
    /**
     * getToken 
     * 
     * @access public
     * @return void
     */
    public function getToken()
    {
        return $this->token;
    }
    
    /**
     * setToken 
     * 
     * @param TokenInterface $token 
     * @access public
     * @return void
     */
    public function setToken(TokenInterface $token)
    {
        $this->token = $token;
        return $this;
    }
	
	public function getAuthenticationProvider()
	{
		return $this->getToken()->getAuthenticationProvider();
	}

	public function setAuthenticationProvider(Provider $provider)
	{
		$this->getToken()->setAuthenticationProvider($provider);
		return $this;
	}

	public function isAuthenticated()
	{
		return $this->getToken()->isAuthenticated()
	}

	public function isUserCredentials()
	{
		return $this->getToken()->isUserCredentials();
	}

	public function getUser()
	{
		return $this->getToken()->getUser();
	}

}

