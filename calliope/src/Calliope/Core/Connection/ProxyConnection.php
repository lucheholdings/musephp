<?php
namespace Calliope\Core\Connection;

use Calliope\Core\Connection;
use Calliope\Core\Manager;

class ProxyConnection implements Connection 
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
	 * getConnectFrom 
	 * 
	 * @access public
	 * @return void
	 */
	public function getConnectFrom()
	{
		return $this->getConnection()->getConnectFrom();
	}

	/**
	 * connect 
	 * 
	 * @param Manager $from 
	 * @access public
	 * @return void
	 */
	public function connect(Manager $from)
	{
		return $this->getConnection()->connect($from);
	}

	/**
	 * disconnect 
	 * 
	 * @access public
	 * @return void
	 */
	public function disconnect()
	{
		return $this->getConnection()->disconnect();
	}

	/**
	 * getConnectToName 
	 * 
	 * @access public
	 * @return void
	 */
	public function getConnectToName()
	{
		return $this->getConnection()->getConnectToName();
	}

	/**
	 * __call 
	 * 
	 * @param mixed $method 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function __call($method, array $args = array())
	{
		return call_user_func_array(array($this->getConnection(), $method), $args);
	}
}

