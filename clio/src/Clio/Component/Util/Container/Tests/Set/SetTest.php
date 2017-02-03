<?php
namespace Clio\Component\Util\Container\Tests\Set;

use Clio\Component\Util\Container\Set\Set;

/**
 * SetTest 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SetTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * testSuccess 
	 * 
	 * @access public
	 * @return void
	 */
	public function testSuccess()
	{
		$set = $this->createSet();

		$this->assertCount(0, $set);
		$set->add('foo');
		$this->assertCount(1, $set);
		$set->add('bar');
		$this->assertCount(2, $set);

		$this->assertTrue($set->has('foo'));
		$this->assertCount(2, $set);
	
		$set->remove('foo');
		$this->assertCount(1, $set);
	}

	/**
	 * createSet 
	 * 
	 * @access private
	 * @return void
	 */
	private function createSet()
	{
		return new Set();
	}
}

