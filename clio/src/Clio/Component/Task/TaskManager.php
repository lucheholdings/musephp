<?php
namespace Clio\Component\Task;

use Clio\Component\Task\Task\ScheduledTask;

class TaskManager  
{
	private $schedulers;

	private $defaultScheduleType;

	private $managedTasks;

	private $executors;

	public function __construct(Scheduler $defaultScheduler = null, $defaultScheduleType ='default')
	{
		if($defaultScheduler) {
			$defaultScheduler->setManager($this);
			$this->schedulers[$defaultScheduleType] = $defaultScheduler;
		}

		$this->defaultScheduleType = $defaultScheduleType;
	}

	public function scheduleTask(Task $task, $scheduleType = null)
	{
		if(!$scheduleType) {
			$scheduleType = $this->defaultScheduleType;
		}
		return $this->getScheduler($scheduleType)->scheduleTask($task);
	}

	public function descheduleTask(ScheduledTask $task)
	{
		return $task->getScheduler()->descheduleTask($task);
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
		foreach($executors as $name => $executor) {
			$this->setExecutor($name, $executor);
		}
        return $this;
    }

	public function setExecutor($name, Executor $executor) 
	{
		$this->executors[$name] = $executor;
	}

	public function getExecutor($name)
	{
		return $this->executors[$name];
	}
    
	public function getScheduler($scheduleType = null)
	{
		if(!$scheduleType) {
			$scheduleType = $this->defaultScheduleType;
		}
		if(!isset($this->schedulers[$scheduleType])) {
			throw new \InvalidArgumentException(sprintf('ScheduleType "%s" is not defined.', $scheduleType));
		}
		return $this->schedulers[$scheduleType];
	}
    public function getSchedulers()
    {
        return $this->schedulers;
    }
    
	public function addScheduler($scheduleType, Scheduler $scheduler)
	{
		if(isset($this->schedulers[$scheduleType])) {
			throw new \RuntimeException(sprintf('ScheduleType "%s" is already exists.', $scheduleType));
		}
		$scheduler->setManager($this);
		$this->schedulers[$scheduleType] = $scheduler;
		return $this;
	}
    
    public function getDefaultScheduleType()
    {
        return $this->defaultScheduleType;
    }
    
    public function setDefaultScheduleType($defaultScheduleType)
    {
        $this->defaultScheduleType = $defaultScheduleType;
        return $this;
    }
}
