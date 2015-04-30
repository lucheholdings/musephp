<?php
namespace Clio\Component\Task\Scheduler;

use Clio\Component\Task\Task,
	Clio\Component\Task\TaskManager,
	Clio\Component\Task\Task\ScheduledTask
;
use Clio\Component\Task\Exception as TaskExceptions;
use Clio\Component\Task\Scheduler;
use Clio\Component\Container;

class QueuedTaskScheduler implements Scheduler, \Countable
{
	private $queue;

	protected $scheduledTasks;	

	protected $manager;

	public function __construct(Container\Queue $queue, Container\Map $map = null)
	{
		$this->queue = $queue;
		if(!$map) {
			$map = new Container\ArrayImpl\Map();
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
		return $this->run();
	}

	/**
	 * run 
	 *   Run the first task 
	 * @access public
	 * @return void
	 */
	public function run()
	{
		if(0 == count($this->getQueue())) {
			throw new TaskExceptions\NoMoreTaskException('No more task to wait.');
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

	public function count()
	{
		return count($this->getQueue());
	}
}

