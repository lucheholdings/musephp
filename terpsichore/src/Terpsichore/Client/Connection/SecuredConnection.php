<?php
namespace Terpsichore\Client\Connection;

use Terpsichore\Client\Connection;

use Terpsichore\Client\Auth\Provider as AuthenticationProvider;
use Terpsichore\Client\Auth\Token;
use Terpsichore\Client\Request\AnonymousRequest;
use Terpsichore\Client\Request;
use Terpsichore\Client\Auth\Request\RequestResolver;

/**
 * SecuredConnection 
 * 
 * @uses AbstractProxyConnection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SecuredConnection extends PassThruConnection implements \Serializable 
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
		if(!$request instanceof AnonymousRequest) {
			// if this is not authenticated, then authenticate with provider
			if(!$this->isAuthenticated()) {
				$this->authenticate();
			}
			
			// Resolve Request for SecuredConnection
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


	/**
	 * serialize 
	 * 
	 * @access public
	 * @return void
	 */
	public function serialize()
	{
		return serialize($this->token);
	}

	/**
	 * unserialize 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	public function unserialize($data)
	{
		$token = unserialize($data);
		$this->token = $token;
	}
}

