<?php
namespace Terpsichore\Client\Exception;

class NotSecuredConnectionException extends \RuntimeException implements ConnectionException 
{
	private $connection;

	public function getConnection()
	{
		return $this->connection;
	}
}

