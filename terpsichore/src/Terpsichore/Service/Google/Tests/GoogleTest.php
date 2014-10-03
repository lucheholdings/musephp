<?php
namespace Terpsichore\Service\Google\Tests;

use Terpsichore\Service\Google\Google;
use Terpsichore\Service\Test\DummyConnection;

use Terpsichore\Core\Connection;
use Terpsichore\Core\Auth\Token\PreAuthenticateToken;

class GoogleTest extends \PHPUnit_Framework_TestCase 
{
	public function testComponent()
	{
		$service = $this->createService();

		$this->assertInstanceof('Terpsichore\Core\Auth\OAuth\GenericOAuth2Provider', $service->auth);
		$this->assertInstanceof('Terpsichore\Core\Auth\Http\HttpAuthenticatedUserProvider', $service->userinfo);
	}

	public function testAuthenticate()
	{
		$connection = $this->createDummyConnection();
		$service = $this->createService($connection);
		
		// Set authentication token 
		$service->setToken(new PreAuthenticateToken('oauth2', array()));

		$service->getConnection()->authenticate();
		$token = $service->getConnection()->getToken();

		$this->assertInstanceof('Terpsichore\Core\Auth\OAuth\OAuth2Token', $token);
		$this->assertEquals('accesstoken', $token->getToken());
		$this->assertEquals('http://test.com', $token->getScopes());
		$this->assertEquals(3600, $token->getExpiresIn());
	}


	public function testUser()
	{
		$connection = $this->createDummyConnection();
		$connection
			->addResponse(array(
				'id' => 1234567890,
				'email' => 'whoami'
			))
		;
		$service = $this->createService($connection);
		
		// Set authentication token 
		$service->setToken(new PreAuthenticateToken('oauth2', array()));

		$service->getConnection()->authenticate();

		$user = $service->getAuthenticatedUser();

		$this->assertInstanceof('Terpsichore\Core\Auth\User', $user);

		$this->assertEquals(1234567890, $user->getId());

		$this->assertEquals('whoami', $user->get('username'));
	}
	

	protected function createService(Connection $connection = null)
	{
		if(!$connection) {
			$connection = new DummyConnection();
		}

		return new Google($connection);
	}

	public function createDummyConnection()
	{
		$connection = new DummyConnection();

		$connection->addResponse(array(
			'access_token' => 'accesstoken',
			'expires_in' => 3600,
			'token_type' => 'bearer',
			'scope' => 'http://test.com'
		));
		
		return $connection;
	}
}

