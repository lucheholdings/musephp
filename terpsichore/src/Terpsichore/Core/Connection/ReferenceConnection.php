<?php
namespace Terpsichore\Core\Connection;

use Terpsichore\Core\Request;

/**
 * ReferenceConnection 
 * 
 * @uses ProxyConnection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ReferenceConnection implements ProxyConnection
{
	/**
	 * connectionContainer 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $connectionContainer;

	/**
	 * __construct 
	 * 
	 * @param ConnectionContainer $container 
	 * @access public
	 * @return void
	 */
	public function __construct(ConnectionContainer $container)
	{
		$this->connectionContainer = $container;
	}

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
		return $this->getConnectionContainer()->getConnection(); 
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
    
    /**
     * getConnectionContainer 
     * 
     * @access public
     * @return void
     */
    public function getConnectionContainer()
    {
        return $this->connectionContainer;
    }
    
    /**
     * setConnectionContainer 
     * 
     * @param ConnectionContainer $connectionContainer 
     * @access public
     * @return void
     */
    public function setConnectionContainer(ConnectionContainer $connectionContainer)
    {
        $this->connectionContainer = $connectionContainer;
        return $this;
    }
}
