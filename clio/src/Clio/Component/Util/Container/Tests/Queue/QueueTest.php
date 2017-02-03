<?php
namespace Clio\Component\Util\Container\Tests\Queue;

use Clio\Component\Util\Container\Queue\Queue;

/**
 * QueueTest 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class QueueTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * testSuccess 
	 * 
	 * @access public
	 * @return void
	 */
	public function testSuccess()
	{
		$queue = $this->createQueue();

		$this->assertCount(0, $queue);
		$queue->enqueue('foo');
		$this->assertCount(1, $queue);
		$queue->enqueue('bar');
		$this->assertCount(2, $queue);

		$this->assertEquals('foo', $queue->peek());
		$this->assertCount(2, $queue);
	
		$this->assertEquals('foo', $queue->dequeue());
		$this->assertCount(1, $queue);
		$this->assertEquals('bar', $queue->dequeue());
	}

	private function createQueue()
	{
		return new Queue();
	}
}

