<?php
namespace Clio\Component\Util\Task\Executor;

abstract class AbstractExecutor implements Executor 
{
	public function run(Task $task)
	{
		try {
			$task->start();
			$result = $this->doRun($task);
		} catch(\Exception $ex) {
			$task->setError($ex);
		}

		$task->setResult($result);

		return $task;
	}

	abstract protected function doRun(Task $task);
}

