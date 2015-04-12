<?php
namespace Clio\Component\Util\Task\Tests\Task;

use Clio\Component\Util\Test\TestCase;
use Clio\Component\Util\Task\Task\Task;

/**
 * TaskTest 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class TaskTest extends TestCase 
{
	public function testGetterSetter()
	{
		$task = new Task('task', array());

		$this->assertEquals('task', $task->getName());
		$task->setName('newtask');
		$this->assertEquals('newtask', $task->getName());

		$this->assertEmpty($task->getArguments());
		$task->setArguments(array('arg1' => 'Arg1'));
		$this->assertNotEmpty($task->getArguments());
		$this->assertContains('Arg1', $task->getArguments());

		$task->setArgument('arg2', 'Arg2');
		$this->assertContains('Arg2', $task->getArguments());

		$task->addArgument('Arg3');
		$this->assertContains('Arg3', $task->getArguments());

		$this->assertFalse($task->isStarted());
		$this->assertFalse($task->isFinished());

		// cause not finished.
		$this->assertThrowException('\RuntimeException', function() use ($task) { 
				$this->assertFalse($task->isSuccessed());
			});
		$this->assertThrowException('\RuntimeException', function() use ($task) { 
				$this->assertFalse($task->isFailed());
			});

		$task->setResult('result');
		$this->assertTrue($task->isSuccessed());
		$this->assertFalse($task->isFailed());

		$this->assertThrowException('\RuntimeException', function() use ($task) { 
				$task->setResult('reset result');	
			});
		
	}
}
