<?php
namespace Calliope\Core\Connection;

use Calliope\Core\Connection;
use Calliope\Core\Manager;

/**
 * AbstractConnection 
 * 
 * @uses Connection
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractConnection implements Connection 
{
	/**
	 * connectFrom
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $connectFrom;

	/**
	 * connectTo 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $connectTo;

	/**
	 * options 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $options;

	/**
	 * __construct 
	 * 
	 * @param Manager $connectFrom 
	 * @param mixed $connectTo 
	 * @access public
	 * @return void
	 */
	public function __construct($connectTo = null, array $options = array())
	{
		$this->options = $options;

		$this->setConnectTo($connectTo);
	}
    
    /**
     * Get connectFrom.
     *
     * @access public
     * @return connectFrom
     */
    public function getConnectFrom()
    {
		if(!$this->connectFrom) {
			throw new \RuntimeException('Connection is disconnected.');
		}
        return $this->connectFrom;
    }
    
    /**
     * Get connectTo.
     *
     * @access public
     * @return connectTo
     */
    public function getConnectTo()
    {
        return $this->connectTo;
    }
    
    /**
     * Set connectTo.
     *
     * @access public
     * @param connectTo the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setConnectTo($connectTo)
    {
		$this->disconnect();
		$this->connectTo = $connectTo;

        return $this;
    }

	/**
	 * connect 
	 *   Establish connection 
	 * @access public
	 * @return void
	 */
	public function connect(Manager $from)
	{
		$this->connectFrom = $from;
		$this->doConnect();
	}

	public function disconnect()
	{
		$this->connectFrom = null;
	}

	/**
	 * doConnect 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function doConnect()
	{
	}
}

