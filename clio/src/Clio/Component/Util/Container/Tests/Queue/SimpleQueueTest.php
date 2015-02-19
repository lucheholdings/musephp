<?php
namespace Clio\Component\Util\Container\Tests\Queue;

use Clio\Component\Util\Test\TestCase;
use Clio\Component\Util\Container\Queue\SimpleQueue;

class SimpleQueueTest extends TestCase 
{
	public function testContain()
	{
		$queue = new SimpleQueue();

		$this->assertEquals(0, $queue->count());

		$queue->enqueue(1);
		$this->assertEquals(1, $queue->count());

		$queue->enqueue(2);
		$this->assertEquals(2, $queue->count());
		
		$this->assertEquals(1, $queue->begin());
		$this->assertEquals(2, $queue->end());

		$dequeued = $queue->dequeue();
		$this->assertEquals(1, $dequeued);
	}
}

