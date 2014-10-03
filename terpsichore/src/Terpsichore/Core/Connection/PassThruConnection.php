<?php
namespace Terpsichore\Core\Connection;

use Terpsichore\Core\Connection;
use Terpsichore\Core\Request;
/**
 * PassThruConnection 
 * 
 * @uses ProxyConnection
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PassThruConnection implements ProxyConnection
{
	/**
	 * connection 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $connection;

	/**
	 * __construct 
	 * 
	 * @param Connection $connection 
	 * @access public
	 * @return void
	 */
	public function __construct(Connection $connection)
	{
		$this->connection = $connection;
	}

	/**
	 * send 
	 * 
	 * @param Request $request 
	 * @access public
	 * @return void
	 */
	public function send(Request $request)
	{
		return $this->getConnection()->send($request);
	}
    
    /**
     * getConnection 
     * 
     * @access public
     * @return void
     */
    public function getConnection()
    {
        return $this->connection;
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
        $this->connection = $connection;
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
		return $this->getConnection()->isSecured();
	}

	/**
	 * getSecuredConnection 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSecuredConnection()
	{
		return $this->getConnection()->getSecuredConnection();
	}
}

