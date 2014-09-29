<?php
namespace Calliope\Framework\Core\Event;

use Calliope\Framework\Core\Connection;
/**
 * ConnectionEvent 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ConnectionEvent 
{
	private $connection;

	public function __construct(Connection $connection)
	{
		$this->connection = $connection;
	}

	public function getConnection()
	{
		return $this->connection;
	}

	public function getManager()
	{
		return $this->connection->getConnectFrom();
	}

	public function getClassMetadata()
	{
		return $this->connection->getClassMetadata();
	}

	public function getConnectTo()
	{
		return $this->connection->getConnectTo();
	}
}

