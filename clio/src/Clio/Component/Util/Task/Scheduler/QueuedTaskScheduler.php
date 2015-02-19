<?php
namespace Clio\Component\Util\Task\Scheduler;

use Clio\Component\Util\Task\Task,
	Clio\Component\Util\Task\TaskManager,
	Clio\Component\Util\Task\Task\ScheduledTask
;
use Clio\Component\Util\Task\Scheduler;
use Clio\Component\Util\Container\Queue,
	Clio\Component\Util\Container\Map
;

class QueuedTaskScheduler implements Scheduler
{
	private $queue;

	protected $scheduledTasks;	

	protected $manager;

	public function __construct(Queue $queue, Map $map)
	{
		$this->queue = $queue;
		$this->scheduledTasks = $map;
	}

	public function scheduleTask(Task $task)
	{
		$scheduledTask = new ScheduledTask($task);
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
		if($task instanceof ScheduledTask) {
			//$taskId = $task->getId();
		} else if(is_scalar($task)) {
			// get task from manager
			try {
				$task = $this->getScheduledTasks()->getTask($task);
			} catch(\InvalidArgumentException $ex) {
				throw new \RuntimeException(sprintf('Task "%s" is not found.', (string)$task));
			}
		} else {
			throw new \InvalidArgumentException('$task has to be ScheduledTask or taskId.');
		}

		if(!$task->isScheduled()) {
			throw new \RuntimeException('Task is not scheduled, so you cannot wait the task to done.');
		}

		while($task->isPending()) {
			$this->wait();
		}
		
		return $task;
	}

	protected function wait()
	{
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

