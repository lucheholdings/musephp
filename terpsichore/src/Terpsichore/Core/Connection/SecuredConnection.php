<?php
namespace Terpsichore\Core\Connection;

use Terpsichore\Core\Connection;

use Terpsichore\Core\Auth\Provider as AuthenticationProvider;
use Terpsichore\Core\Auth\Token;
use Terpsichore\Core\Auth\Request\AuthenticationRequest;
use Terpsichore\Core\Request;
use Terpsichore\Core\Auth\Request\RequestResolver;

/**
 * SecuredConnection 
 * 
 * @uses AbstractProxyConnection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SecuredConnection extends PassThruConnection 
{
	/**
	 * authenticationProvider 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $authenticationProvider;

	/**
	 * token 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $token;

	/**
	 * requestResolver 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $requestResolver;

	/**
	 * __construct 
	 * 
	 * @param Connection $connection 
	 * @param AuthenticationProvider $provider 
	 * @param Token $token 
	 * @access public
	 * @return void
	 */
	public function __construct(Connection $connection, AuthenticationProvider $provider = null, Token $token = null)
	{
		parent::__construct($connection);

		$this->authenticationProvider = $provider;
		$this->token = $token;
	}

	/**
	 * send 
	 * 
	 * @param mixed $request 
	 * @access public
	 * @return void
	 */
	public function send(Request $request)
	{
		// check if the request is authentication request
		// then thru
		if(!$request instanceof AuthenticationRequest) {
			// if this is not authenticated
			if(!$this->isAuthenticated()) {
				$this->authenticate();
			}

			if($resolver = $this->getRequestResolver()) {
				$resolver->resolveRequest($request, $this->getToken());
			}
		}

		return $this->getConnection()->send($request);
	}

	/**
	 * authenticate 
	 * 
	 * @access public
	 * @return void
	 */
	public function authenticate()
	{
		$this->token = $this->getAuthenticationProvider()->authenticate($this->getToken());
	}

	/**
	 * isAuthenticated 
	 * 
	 * @access public
	 * @return void
	 */
	public function isAuthenticated()
	{
		return (bool)$this->getToken()->isAuthenticated();
	}

    /**
     * getAuthenticationProvider 
     * 
     * @access public
     * @return void
     */
    public function getAuthenticationProvider()
    {
        return $this->authenticationProvider;
    }
    
    /**
     * setAuthenticationProvider 
     * 
     * @param AuthenticationProvider $authenticationProvider 
     * @access public
     * @return void
     */
    public function setAuthenticationProvider(AuthenticationProvider $authenticationProvider)
    {
        $this->authenticationProvider = $authenticationProvider;
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
		if(!$this->token) {
			throw new \RuntimeException('Token for secured connection is not initialized.');
		}
        return $this->token;
    }
    
    /**
     * setToken 
     * 
     * @param Token $token 
     * @access public
     * @return void
     */
    public function setToken(Token $token)
    {
        $this->token = $token;
        return $this;
    }

	/**
	 * isSecured 
	 * 
	 * @access public
	 * @return void
	 */
	public function isSecured()
	{
		return true;
	}

	/**
	 * getSecuredConnection 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSecuredConnection()
	{
		return $this;
	}
    
    public function getRequestResolver()
    {
        return $this->requestResolver;
    }
    
    public function setRequestResolver(RequestResolver $requestResolver)
    {
        $this->requestResolver = $requestResolver;
        return $this;
    }
}

