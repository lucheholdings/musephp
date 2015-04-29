<?php
namespace Calliope\Core\Schema\Mapping;

use Clio\Component\Metadata;
use Calliope\Core\Connection;

/**
 * ConnectionMapping 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ConnectionMapping extends Metadata\Mapping\AbstractMapping
{
    const OPTION_CONNECT_TYPE     = 'connect_type';
    const OPTION_CONNECT_TO       = 'connect_to';
    const OPTION_CONNECT_OPTIONS  = 'connect_options';

    /**
     * connectionFactory 
     * 
     * @var Connection\TypedFactory 
     * @access private
     */
    private $connectionFactory;

    /**
     * _connection 
     * 
     * @var Connection 
     * @access private
     */
    private $_connection;

    /**
     * __construct 
     * 
     * @param Metadata $metadata 
     * @param TypedConnectionFactory $connectionFactory 
     * @param array $options 
     * @access public
     * @return void
     */
    public function __construct(Metadata\Metadata $metadata, Connection\TypedFactory $connectionFactory, array $options = array())
    {
        $this->connectionFactory = $connectionFactory;

        parent::__construct($metadata, $options);
    }

    /**
     * getConnection 
     * 
     * @access public
     * @return void
     */
    public function getConnection()
    {
        if(!$this->_connection) {
            $this->_connection = $this->getConnectionFactory()->createConnection($this->getConnectionType(), $this->getConnectTo(), $this->getConnectionOptions());
        }
        return $this->_connection;
    }

    /**
     * getConnectionFactory 
     * 
     * @access public
     * @return void
     */
    public function getConnectionFactory()
    {
        return $this->connectionFactory;
    }

    /**
     * getConnectionType 
     * 
     * @access public
     * @return void
     */
    public function getConnectionType()
    {
        return $this->getOption('connect_type');
    }

    /**
     * getConnectTo 
     * 
     * @access public
     * @return void
     */
    public function getConnectTo()
    {
        return $this->getOption('connect_to');
    }

    /**
     * getConnectOptions 
     * 
     * @access public
     * @return void
     */
    public function getConnectOptions()
    {
        return $this->getOption('connect_options');
    }
}

