<?php
namespace Terpsichore\Client\Service;

use Terpsichore\Client\Service;
use Terpsichore\Client\Connection;
use Terpsichore\Client\Connection\ConnectionContainer;
use Terpsichore\Client\Connection\SecuredConnection;

use Terpsichore\Client\Auth\Provider as AuthenticationProvider;
use Terpsichore\Client\Auth\Token;

/**
 * GenericClientServiceProvider 
 * 
 * @uses AbstractClientService
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class GenericClientServiceProvider extends BasicServiceProvider implements ConnectionContainer
{
	/**
	 * _connection 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $_connection;

	/**
	 * __construct 
	 * 
	 * @param Connection $connection 
	 * @access public
	 * @return void
	 */
	public function __construct(Connection $connection = null)
	{
		$this->_connection = $connection;

		parent::__construct();
	}

	/**
	 * setService 
	 * 
	 * @param mixed $name 
	 * @param Service $service 
	 * @access public
	 * @return void
	 */
	public function setService($name, Service $service)
	{
		if($service instanceof ClientService) {
			$service->setConnection(new Connection\ReferenceConnection($this));
		}

		parent::setService($name, $service);
	}

	/**
	 * setAuthenticationProvider 
	 * 
	 * @param AuthenticationProvider $provider 
	 * @access public
	 * @return void
	 */
	public function setAuthenticationProvider(AuthenticationProvider $provider)
	{
		$this->setService('auth', $provider);

		if(!$this->getConnection()->isSecured()) {
			$this->setConnection(new SecuredConnection($this->getConnection()));
		}
		$this->getConnection()->getSecuredConnection()->setAuthenticationProvider($provider);
		return $this;
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
		if(!$this->getConnection()->isSecured()) {
			$this->setConnection(new SecuredConnection($this->getConnection()));
		}
		$this->getConnection()->getSecuredConnection()->setToken($token);
		return $this;
	}

    /**
     * getConnection 
     * 
     * @access public
     * @return void
     */
    public function getConnection()
    {
        return $this->_connection;
    }
    
    /**
     * setConnection 
     * 
     * @param Connection $connection 
     * @access public
     * @return void
     */
    public function setConnection(Connection $connection)
    {
        $this->_connection = $connection;
        return $this;
    }
}
