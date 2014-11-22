<?php
namespace Terpsichore\Bridge\GuzzleHttp;

use Terpsichore\Client\Exception\TransferException;
use Terpsichore\Core\Request;
use Terpsichore\Client\Connection;

class GuzzleTransferException extends TransferException 
{
	public function __construct(Connection $connection, \GuzzleHttp\Exception\TransferException $ex, Request $request, $response = null, $code = 0)
	{
		parent::__construct($connection, $request, null, $ex->getMessage(), $code, $ex);	
	}

	public function getGuzzleException()
	{
		return $this->getPrevious();
	}

	public function getResponseHeaders()
	{
		$response = $this->getGuzzleException()->getResponse();
		if($response) {
			return $response->getHeaders();
		}
		
		return null;
	}

	public function getResponseBody()
	{
		$response = $this->getGuzzleException()->getResponse();
		if($response) {
			return $response->body();
		}
		
		return null;
	}
}

