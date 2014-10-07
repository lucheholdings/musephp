<?php
namespace Terpsichore\Core\Auth\OAuth\Token;

use Terpsichore\Core\Auth\OAuth\OAuth2Token as OAuth2TokenInterface;
use Terpsichore\Core\Auth\Token\AbstractToken;

/**
 * OAuth2Token 
 * 
 * @uses AbstractToken
 * @uses OAuth2TokenInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class OAuth2Token extends AbstractToken implements OAuth2TokenInterface
{
	/**
	 * type 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $type;

	/**
	 * token 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $token;

	/**
	 * refreshToken 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $refreshToken;
	
	/**
	 * scopes 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $scopes;

	/**
	 * expiresIn 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $expiresIn;
    
    /**
     * getType 
     * 
     * @access public
     * @return void
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * setType 
     * 
     * @param mixed $type 
     * @access public
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
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
     * @param mixed $token 
     * @access public
     * @return void
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }
    
    /**
     * getRefreshToken 
     * 
     * @access public
     * @return void
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }
    
    /**
     * setRefreshToken 
     * 
     * @param mixed $refreshToken 
     * @access public
     * @return void
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
        return $this;
    }
    
    /**
     * getScopes 
     * 
     * @access public
     * @return void
     */
    public function getScopes()
    {
        return $this->scopes;
    }
    
    /**
     * setScopes 
     * 
     * @param mixed $scopes 
     * @access public
     * @return void
     */
    public function setScopes($scopes)
    {
        $this->scopes = $scopes;
        return $this;
    }
    
    /**
     * getExpiresIn 
     * 
     * @access public
     * @return void
     */
    public function getExpiresIn()
    {
        return $this->expiresIn;
    }
    
    /**
     * setExpiresIn 
     * 
     * @param mixed $expiresIn 
     * @access public
     * @return void
     */
    public function setExpiresIn($expiresIn)
    {
        $this->expiresIn = $expiresIn;
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
		return 'oauth2';
	}

	/**
	 * isAuthenticated 
	 * 
	 * @access public
	 * @return void
	 */
	public function isAuthenticated()
	{
		return !is_null($this->token);
	}
}