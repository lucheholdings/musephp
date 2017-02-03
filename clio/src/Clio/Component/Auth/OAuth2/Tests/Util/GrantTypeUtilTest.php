<?php
namespace Clio\Component\Auth\OAuth2\Tests\Util;

use Clio\Component\Auth\OAuth2\GrantTypes;
use Clio\Component\Auth\OAuth2\Util\GrantTypeUtil;

/**
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class GrantTypeUtilTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * testGuess 
	 * 
	 * @access public
	 * @return void
	 */
	public function testGuess()
	{
		$util = new GrantTypeUtil();


		// if only client_id and client_secret, then client_credentials grantType 
		$this->assertEquals(
			GrantTypes::CLIENT_CREDENTIALS,
			$util->guess(array('client_id' => 'abc', 'client_secret' => 'xxx', 'foo' => 'bar'))
		);

		// if username and password is given with client_id and client_secret, then password grantType 
		$this->assertEquals(
			GrantTypes::PASSWORD,
			$util->guess(array('client_id' => 'abc', 'client_secret' => 'xxx', 'username' => 'user', 'password' => 'pswd', 'foo' => 'bar'))
		);

		// if code is given with client_id and client_secret, then authorization_code grantType 
		$this->assertEquals(
			GrantTypes::AUTHORIZATION_CODE,
			$util->guess(array('client_id' => 'abc', 'client_secret' => 'xxx', 'code' => '1234567', 'foo' => 'bar'))
		);
		

		// if either client_id or client_secret missed, null return
		$this->assertNull(
			$util->guess(array('client' => 'abc', 'client_secret' => 'xxx', 'code' => '1234567', 'foo' => 'bar'))
		);
	}
}

