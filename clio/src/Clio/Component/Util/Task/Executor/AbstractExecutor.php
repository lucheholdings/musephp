<?php
namespace Clio\Component\Util\Task\Executor;

use Clio\Component\Util\Task\Executor;
use Clio\Component\Util\Task\Task;

/**
 * AbstractExecutor 
 * 
 * @uses Executor
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractExecutor implements Executor 
{
	/**
	 * run 
	 * 
	 * @param Task $task 
	 * @access public
	 * @return void
	 */
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

	/**
	 * doRun 
	 * 
	 * @param Task $task 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function doRun(Task $task);
}

