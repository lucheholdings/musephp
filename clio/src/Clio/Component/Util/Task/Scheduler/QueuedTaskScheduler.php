<?php
namespace Clio\Component\Util\Task\Scheduler;

use Clio\Component\Util\Task\Task,
	Clio\Component\Util\Task\TaskManager,
	Clio\Component\Util\Task\Task\ScheduledTask
;
use Clio\Component\Util\Task\Scheduler;
use Clio\Component\Util\Container\Queue,
	Clio\Component\Util\Container\Map,
	Clio\Component\Util\Container\SimpleMap
;

class QueuedTaskScheduler implements Scheduler
{
	private $queue;

	protected $scheduledTasks;	

	protected $manager;

	public function __construct(Queue $queue, Map $map = null)
	{
		$this->queue = $queue;
		if(!$map) {
			$map = new SimpleMap();
		}
		$this->scheduledTasks = $map;
	}

	public function scheduleTask(Task $task)
	{
		$task = clone $task;
		$scheduledTask = new ScheduledTask($this, $task);
		$scheduledTask->setId(uniqid());

		$this->getQueue()->enqueue($scheduledTask);
		$this->getScheduledTasks()->set($scheduledTask->getId(), $scheduledTask);
		return $scheduledTask;
	}

	public function descheduleTask(ScheduledTask $task)
	{
		throw new \Exception('Not impl yet');
	}

	public function waitFor(ScheduledTask $task)
	{
		while($task->isPending()) {
			$this->wait();
		}
		
		return $task;
	}

	protected function wait()
	{
		if(0 == count($this->getQueue())) {
			throw new \RuntimeException('No more task to wait.');
		}
		$nextTask = $this->getQueue()->dequeue();

		// use executor to execute task
		$this->getManager()->execute($nextTask);

		return $nextTask;
	}
    
    public function getManager()
    {
        return $this->manager;
    }
    
    public function setManager(TaskManager $manager)
    {
        $this->manager = $manager;
        return $this;
    }
    
    public function getQueue()
    {
        return $this->queue;
    }
    
    public function getScheduledTasks()
    {
        return $this->scheduledTasks;
    }
}

