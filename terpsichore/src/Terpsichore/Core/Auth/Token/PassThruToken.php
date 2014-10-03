<?php
namespace Terpsichore\Core\Auth\Token;

use Terpsichore\Core\Auth\Token; 

/**
 * PassThruToken 
 * 
 * @uses ProxyToken
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PassThruToken implements ProxyToken 
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
	public function __construct(Token $token)
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

	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	public function getName()
	{
		return $this->getToken()->getName();
	}

	/**
	 * getProvider 
	 * 
	 * @access public
	 * @return void
	 */
	public function getProvider()
	{
		return $this->getToken()->getProvider();
	}

	/**
	 * isAuthenticated 
	 * 
	 * @access public
	 * @return void
	 */
	public function isAuthenticated()
	{
		return $this->getToken()->isAuthenticated();
	}
}

