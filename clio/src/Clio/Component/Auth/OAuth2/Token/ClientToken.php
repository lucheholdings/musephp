<?php
namespace Clio\Component\Auth\OAuth2\Token;

/**
 * ClientToken
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class ClientToken implements ClientTokenInterface
{
	/*
	 * accessToken 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $accessToken;

	/**
	 * expiresIn 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $expiresIn;

	/**
	 * tokenType 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $tokenType;

	/**
	 * scope 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $scopes;

	/**
	 * refreshToken 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $refreshToken;

	static public function fromArray(array $token)
	{
		$clientToken = new static();
		$clientToken->setAccessToken($token['access_token']);
		$clientToken->setRefreshToken(isset($token['refresh_token']) ? $token['refresh_token'] : null);
		$clientToken->setExpiresIn($token['expires_in']);

		return $clientToken;
	}
	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		// Defualt empty scopes
		$this->scopes = array();
		// Default 0sec remain 
		$this->expiresIn = 0;
		// Default BEARER token
		$this->tokenType = AccessTokenTypes::BEARER; 
	}

	/**
	 * setAccessToken 
	 * 
	 * @param mixed $token 
	 * @access public
	 * @return void
	 */
	public function setAccessToken($token)
	{
		$this->accessToken = $token;
		return $this;
	}

	/**
	 * getAccessToken 
	 * 
	 * @access public
	 * @return void
	 */
	public function getAccessToken()
	{
		return $this->accessToken;
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
	 * setTokenType 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function setTokenType($type)
	{
		$this->tokenType = $type;
		return $this;
	}

	/**
	 * getTokenType 
	 * 
	 * @access public
	 * @return void
	 */
	public function getTokenType()
	{
		return $this->tokenType;
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
	 * setRefreshToken 
	 * 
	 * @param mixed $token 
	 * @access public
	 * @return void
	 */
	public function setRefreshToken($token)
	{
		$this->refreshToken = $token;
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
	 * hasRefreshToken 
	 * 
	 * @access public
	 * @return void
	 */
	public function hasRefreshToken()
	{
		return !empty($this->refreshToken);
	}
}

