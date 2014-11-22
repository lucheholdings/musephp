<?php
namespace Terpsichore\Bridge\Buzz;

use Terpsichore\Client\Exception\TransferException;
use Terpsichore\Core\Request;
use Terpsichore\Client\Connection;

class BuzzTransferException extends TransferException 
{
	public function __construct(Connection $connection, \Buzz\Exception\ExceptionInterface $ex, Request $request, $response = null, $code = 0)
	{
		parent::__construct($connection, $request, null, $ex->getMessage(), $code, $ex);	
	}

	public function getBuzzException()
	{
		return $this->getPrevious();
	}

	public function getResponseHeaders()
	{
		$response = $this->getBuzzException()->getResponse();
		if($response) {
			return $response->getHeaders();
		}
		
		return null;
	}

	public function getResponseBody()
	{
		$response = $this->getBuzzException()->getResponse();
		if($response) {
			return $response->body();
		}
		
		return null;
	}
}

