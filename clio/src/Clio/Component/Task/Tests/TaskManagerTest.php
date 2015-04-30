<?php
namespace Clio\Component\Task\Tests;

use Clio\Component\Test\TestCase;

use Clio\Component\Task\Task\Task,
	Clio\Component\Task\Scheduler\QueuedTaskScheduler,
	Clio\Component\Task\TaskManager
;

use Clio\Component\Task\Executor\ClosureExecutor;

use Clio\Component\Container\ArrayImpl\Queue;
use Clio\Component\Container\ArrayImpl\Map;

class TaskManagerTest extends TestCase 
{
	public function testSchedule()
	{
		$task = new Task('task');
		$taskManager = new TaskManager(new QueuedTaskScheduler(new Queue(), new Map()));
		$taskManager->setExecutor('task', new ClosureExecutor(function($task) {
				return 'success';
			}));

		$scheduled = $taskManager->scheduleTask($task);

		$this->assertInstanceof('Clio\Component\Task\Task\ScheduledTask', $scheduled);

		$scheduled->wait();

		$this->assertTrue($scheduled->isSuccessed());
		$this->assertEquals('success', $scheduled->getResult());
	}
}

