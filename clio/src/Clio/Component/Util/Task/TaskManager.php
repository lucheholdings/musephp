<?php
namespace Clio\Component\Util\Task;

use Clio\Component\Util\Task\Task\ScheduledTask;

class TaskManager  
{
	private $scheduler;

	private $managedTasks;

	private $executors;

	public function __construct(Scheduler $scheduler)
	{
		$this->scheduler = $scheduler;
		$this->scheduler->setManager($this);
	}

	public function scheduleTask(Task $task)
	{
		return $this->scheduler->scheduleTask($task);
	}

	public function descheduleTask(ScheduledTask $task)
	{
		return $this->scheduler->descheduleTask($task);
	}

	public function execute(Task $task) 
	{
		$executor = $this->getExecutor($task->getName());

		$executor->run($task);
	}
    
    public function getExecutors()
    {
        return $this->executors;
    }
    
    public function setExecutors(array $executors)
    {
		$this->executors = array();
		foreach($executors as $executor) {
			$this->addExecutor($executor);
		}
        return $this;
    }

	public function addExecutor(Executor $executor) 
	{
		$this->executors[$executor->getTaskName()] = $executor;
	}

	public function getExecutor($name)
	{
		return $this->executors[$name];
	}
}
