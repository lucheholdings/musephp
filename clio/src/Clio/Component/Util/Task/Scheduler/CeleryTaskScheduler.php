<?php
namespace ;

class CeleryTaskScheduler
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

		$this->getCelery()->enschedule($task);
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

