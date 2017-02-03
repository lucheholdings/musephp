<?php
namespace Terpsichore\Server\Auth\OAuth\Tests\Util;

use Terpsichore\Server\Auth\OAuth\Util\ScopeUtil;

/**
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class ScopeUtilTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * testArray 
	 * 
	 * @access public
	 * @return void
	 */
	public function testArray()
	{
		$util = new ScopeUtil();

		$scope = $util->fromArray(array('foo', 'bar'));

		$this->assertEquals('foo bar', $scope);

		$scopes = $util->toArray($scope);
		$this->assertCount(2, $scopes);
		$this->assertContains('foo', $scopes);
		$this->assertContains('bar', $scopes);
	}

	/**
	 * testDelimiter 
	 * 
	 * @access public
	 * @return void
	 */
	public function testDelimiter()
	{
		$util = new ScopeUtil(',');

		$this->assertEquals(',', $util->getDelimiter());
	}
}

