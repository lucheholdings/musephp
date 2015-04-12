<?php
namespace Clio\Component\Util\Task\Tests;

use Clio\Component\Util\Test\TestCase;

use Clio\Component\Util\Task\Task\Task,
	Clio\Component\Util\Task\Scheduler\QueuedTaskScheduler,
	Clio\Component\Util\Task\TaskManager
;

use Clio\Component\Util\Task\Executor\ClosureExecutor;

use Clio\Component\Util\Container\Queue\SimpleQueue;
use Clio\Component\Util\Container\Map\SimpleMap;

class TaskManagerTest extends TestCase 
{
	public function testSchedule()
	{
		$task = new Task('task');
		$taskManager = new TaskManager(new QueuedTaskScheduler(new SimpleQueue(), new SimpleMap()));
		$taskManager->setExecutor('task', new ClosureExecutor(function($task) {
				return 'success';
			}));

		$scheduled = $taskManager->scheduleTask($task);

		$this->assertInstanceof('Clio\Component\Util\Task\Task\ScheduledTask', $scheduled);

		$scheduled->wait();

		$this->assertTrue($scheduled->isSuccessed());
		$this->assertEquals('success', $scheduled->getResult());
	}
}

