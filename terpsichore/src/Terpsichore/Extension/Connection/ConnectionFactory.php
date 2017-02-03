<?php
namespace Terpsichore\Extension\Connection;

use Terpsichore\Bridge\Guzzle\GuzzleHttpClient,
	Terpsichore\Bridge\Buzz\BuzzHttpClient
;

class ClientConnectionFactory 
{
	/**
	 * createClientConnection 
	 * 
	 * @param mixed $client 
	 * @access public
	 * @return void
	 */
	public function createClientConnection($client)
	{
		$connection = null;
		if(is_string($client)) {
			switch($client) {
			case 'guzzle':
				$connection = new GuzzleHttpConnection();
				break;
			case 'buzz':
				$connection = new BuzzHttpConnection();
				break;
			default:
				break;
			}
		} else if(is_object($client)) {
			if($client instanceof \GuzzleHttp\Client) {
				$connection = new GuzzleHttpConnection();
			} else if($client instanceof \Buzz\Client) {
				$connection = new BuzzHttpConnection();
			}
		}

		if(!$connection) {
			throw new \InvalidArgumentException('Invalid client is given.');
		}

		return $connection;
	}
}

