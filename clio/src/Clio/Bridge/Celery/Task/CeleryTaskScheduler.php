<?php
namespace Clio\Bridge\Celery\Task;

use Clio\Component\Util\Task\Scheduler;
use Clio\Component\Util\Task\Task,
	Clio\Component\Util\Task\Task\ScheduledTask
;

class CeleryTaskScheduler implements Scheduler
{
	private $client;

	public function __construct(CeleryClient $client)
	{
		$this->client = $client;
	}
	
	public function add(Task $task) 
	{
		if($task->isScheduled()) {
			throw new \RuntimeException('Task you added is already scheduled.');
		}

		$this->getCelery()->scheduleTask($task);
	}

	public function waitFor(ScheduledTask $task)
	{
		// Wait 
		$this->getCelery()->wait($task);

		$result = $this->getCelery()->getResult($task);

		$task->setResult($result);
		return $task;
	}
}

