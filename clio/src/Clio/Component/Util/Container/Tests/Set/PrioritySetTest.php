<?php
namespace Clio\Component\Util\Container\Tests\Set;

use Clio\Component\Util\Container\Set\PrioritySet;

/**
 * PrioritySetTest 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PrioritySetTest extends \PHPUnit_Framework_TestCase
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
		$set->add('bar', 10);
		$this->assertCount(2, $set);

		$this->assertTrue($set->contains('foo'));
		$this->assertCount(2, $set);

		$this->assertEquals(array('bar', 'foo'), $set->toArray());
	
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
		return new PrioritySet();
	}
}

