<?php
namespace Clio\Component\Auth\OAuth2\Tests\Token;

use Clio\Component\Auth\OAuth2\Token\ClientToken;

/**
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class ClientTokenTest extends \PHPUnit_Framework_TestCase
{
	public function testAccessToken()
	{
		$token = new ClientToken();

		// Default Null
		$this->assertNull($token->getAccessToken());

		// Set and Get Test
		$token->setAccessToken('foo');
		$this->assertEquals('foo', $token->getAccessToken());
	}

	public function testExpiresIn()
	{
		$token = new ClientToken();

		// Default Null
		$this->assertEquals(0, $token->getExpiresIn());

		// Set and Get Test
		$token->setExpiresIn(3600);
		$this->assertEquals(3600, $token->getExpiresIn());
	}

	public function testScopes()
	{
		$token = new ClientToken();

		// Default Null
		$this->assertEmpty($token->getScopes());

		// Set and Get Test
		$token->setScopes(array('foo', 'bar'));
		$this->assertCount(2, $token->getScopes());
		$this->assertContains('foo', $token->getScopes());
		$this->assertContains('bar', $token->getScopes());
	}
	
	public function testRefreshToken()
	{
		$token = new ClientToken();

		// Default Null
		$this->assertNull($token->getRefreshToken());
		$this->assertFalse($token->hasRefreshToken());

		// Set and Get Test
		$token->setRefreshToken('oauth2refreshtoken');
		$this->assertTrue($token->hasRefreshToken());
		$this->assertEquals('oauth2refreshtoken', $token->getRefreshToken());
	}
}
