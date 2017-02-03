<?php
namespace Terpsichore\Server\Auth\OAuth\Tests\Token;

use Terpsichore\Server\Auth\OAuth\Token\ServerToken;

/**
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class ServerTokenTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * testToken 
	 * 
	 * @access public
	 * @return void
	 */
	public function testToken()
	{
		$token = new ServerToken();

		// Default Null
		$this->assertNull($token->getToken());

		// Set and Get Test
		$token->setToken('foo');
		$this->assertEquals('foo', $token->getToken());
	}

	/**
	 * testExpiresIn 
	 * 
	 * @access public
	 * @return void
	 */
	public function testExpires()
	{
		$token = new ServerToken();

		$dt = new \DateTime('tomorrow');
		$token->setExpiresAt($dt);

		$this->assertEquals($dt, $token->getExpiresAt());

		$ge = abs($dt->getTimestamp() - time());

		$this->assertGreaterThanOrEqual($ge, $token->getExpiresIn());
	}

	/**
	 * testScopes 
	 * 
	 * @access public
	 * @return void
	 */
	public function testScopes()
	{
		$token = new ServerToken();

		// Default Null
		$this->assertEmpty($token->getScopes());

		// Set and Get Test
		$token->setScopes(array('foo', 'bar'));
		$this->assertCount(2, $token->getScopes());
		$this->assertContains('foo', $token->getScopes());
		$this->assertContains('bar', $token->getScopes());
	}
}
