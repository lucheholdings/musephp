<?php
namespace Terpsichore\Bridge\Guzzle\Tests;

use Terpsichore\Bridge\Guzzle\GuzzleHttpConnection;
use Terpsichore\Client\Request\ServiceRequest;

/**
 * GuzzleHttpConnectionTest 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class GuzzleHttpConnectionTest extends \PHPUnit_Framework_TestCase 
{
	/**
	 * testConstructDefault 
	 * 
	 * @access public
	 * @return void
	 */
	public function testConstructDefault()
	{
		$connection = new GuzzleHttpConnection();

		$this->assertInstanceof('GuzzleHttp\Client', $connection->getHttpClient());
	}

	/**
	 * testSetClient 
	 * 
	 * @access public
	 * @return void
	 */
	public function testSetClient()
	{
		$client = new \GuzzleHttp\Client();

		$connection = new GuzzleHttpConnection();
		$connection->setHttpClient($client);

		$this->assertEquals($client, $connection->getHttpClient());
	}

	/**
	 * testSend 
	 * 
	 * @access public
	 * @return void
	 */
	public function testSend()
	{
		$mock = new \GuzzleHttp\Subscriber\Mock(
			array(new \GuzzleHttp\Message\Response(200, ['Content-Type' => 'application/json'], \GuzzleHttp\Stream\Stream::factory('{"foo":"Foo"}')))
		); 

		$client = new \GuzzleHttp\Client();
		$client->getEmitter()->attach($mock);

		$connection = new GuzzleHttpConnection($client);

		$response = $connection->send(new ServiceRequest(array('foo' => 'Foo'), array('url' => 'http://test.com', 'method' => 'get')));

		$this->assertArrayHasKey('foo', $response);
	}
}

