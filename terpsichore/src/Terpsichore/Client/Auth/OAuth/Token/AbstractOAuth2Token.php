<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Client\Auth\OAuth\Token;

use Terpsichore\Client\Auth\OAuth\OAuth2Token;
use Terpsichore\Client\Auth\Token\AbstractToken;

/**
 * AbstractOAuth2Token 
 * 
 * @uses OAuth2Token
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractOAuth2Token extends AbstractToken implements OAuth2Token
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
	 *   access_token 
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
	 * {@inheritdoc}
	 */
	private $clientId;

	/**
	 * {@inheritdoc}
	 */
	private $clientSecret;
    
    /**
     * {@inheritdoc}
     */
    public function getToken()
    {
        return $this->token;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getClientId()
    {
        return $this->clientId;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }
    
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }
    
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
        return $this;
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

	public function isAuthenticated()
	{
		return !is_null($this->token);
	}

	public function getName()
	{
		return 'oauth2';
	}
}

