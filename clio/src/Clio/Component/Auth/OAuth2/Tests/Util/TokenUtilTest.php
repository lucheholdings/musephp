<?php
namespace Clio\Component\Auth\OAuth2\Tests\Util;

use Clio\Component\Auth\OAuth2\Util\TokenUtil;

/**
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class TokenUtilTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * testArray 
	 * 
	 * @access public
	 * @return void
	 */
	public function testGeneration()
	{
		$util = new TokenUtil();

		$token1 = $util->generateRandomToken();
		$token2 = $util->generateRandomToken();

		$this->assertNotEquals($token1, $token2);
	}
}

