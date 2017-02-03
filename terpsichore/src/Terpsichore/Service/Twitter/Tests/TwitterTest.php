<?php
namespace Terpsichore\Service\Twitter\Tests;

use Terpsichore\Service\Twitter\Twitter;
use Terpsichore\Service\Test\DummyConnection;
use Terpsichore\Client\Connection;

class TwitterTest extends \PHPUnit_Framework_TestCase 
{
	public function testComponent()
	{
		$service = $this->createService();

		$this->assertInstanceof('Terpsichore\Client\Auth\OAuth\GenericOAuth1Provider', $service->auth);
		$this->assertInstanceof('Terpsichore\Client\Auth\Http\HttpAuthenticatedUserProvider', $service->userinfo);
	}

	public function testAuthenticate()
	{
		$this->markTestIncomplete('Incomplete');
		$connection = new DummyConnection();

		$connection->addResponse(
			array(
				'access_token' => 'accesstoken',
				'expires_in' => 3600,
				'token_type' => 'bearer',
				'scope' => 'http://test.com'
			)
		);
		$service = $this->createService($connection);

	}

	/**
	 * testTweetService 
	 * 
	 * @access public
	 * @return void
	 */
	public function testTweetService()
	{
		$service = $this->createService(new DummyConnection());

		$this->assertInstanceof('Terpsichore\Service\Twitter\TweetService', $service->tweets);

		$service->tweets->post('hello');
		$this->asset
	}

	/*
	public function testUser()
	{
		$accessToken = $_GLOBAL['facebook.access_token'];
		$userId = $_GLOBAL['facebook.user_id'];

		$token = new OAuth2AuthenticatedToken($accessToken);
		
		$service = $this->getService();

		$user = $service->usreinfo();

		$this->assertInstanceof('Terpsichore\Client\Auth\User', $user);
		$this->assertEquals($userId, $user->getId());
	}
	*/

	protected function createService(Connection $connection = null)
	{
		if(!$connection) {
			$connection = new DummyConnection();
		}

		return new Twitter($connection);
	}
}

