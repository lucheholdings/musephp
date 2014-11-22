<?php
namespace Calliope\Core\Connection;

use Calliope\Core\Connection\Factory\TypedConnectionFactory;
/**
 * LazyBindConnection 
 * 
 * @uses ProxyConnection
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class LazyBindConnection extends ProxyConnection 
{
	private $connectFrom;

	private $bound;

	private $connectionFactory;

	private $connectArgs;

	/**
	 * __construct 
	 * 
	 * @param array $connectArgs [string connectionType, string connectTo, array options] 
	 * @access public
	 * @return void
	 */
	public function __construct(TypedConnectionFactory $connectionFactory, array $connectArgs = array())
	{
		$this->connectionFactory = $connectionFactory;
		$this->connectArgs = $connectArgs;

		$this->bound = false;
	}

	public function getConnection()
	{
		if(!$this->bound) {
			$this->bind();
		}
		return parent::getConnection();
	}

	public function isBound()
	{
		return $this->bound;
	}

	public function bind()
	{
		$this->bound = false;

		$this->connection = $this->getConnectionFactory()->createWithArgs($this->connectArgs);
		$this->conenction->setConnectFrom($this->getConnectFrom());

		$this->bound = true;
	}

    /**
     * {@inheritdoc}
     */
    public function getConnectFrom()
    {
        return $this->connectFrom;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setConnectFrom(SchemaManagerInterface $connectFrom)
    {
        $this->connectFrom = $connectFrom;
        return $this;
    }
    
    public function getConnectionFactory()
    {
        return $this->connectionFactory;
    }
    
    public function setConnectionFactory(TypedConnectionFactory $connectionFactory)
    {
        $this->connectionFactory = $connectionFactory;
        return $this;
    }
}

