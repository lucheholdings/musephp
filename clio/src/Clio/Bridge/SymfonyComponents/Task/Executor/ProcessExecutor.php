<?php
namespace Clio\Bridge\SymfonyComponents\Task\Executor;

use Clio\Component\Util\Task\Executor\AbstractExecutor;
use Clio\Component\Util\Task\Task;
use Symfony\Component\Process\Process;

/**
 * ProcessExecutor 
 * 
 * @uses AbstractExecutor
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ProcessExecutor extends AbstractExecutor 
{
	const ARG_COMMAND      = 'cmd';
	const ARG_WORKING_DIR  = 'dir';
	const ARG_ENVIRONMENT  = 'env';
	const ARG_TIMEOUT      = 'timeout';
	const ARG_STDIN        = 'stdin';
	const ARG_PROCESS_OPTIONS = 'options';
	const ARG_OUTPUT_HANDLER  = 'handler';

	private $defaults;

	/**
	 * __construct 
	 * 
	 * @param mixed $command 
	 * @param mixed $workingDir 
	 * @param int $timeout 
	 * @access public
	 * @return void
	 */
	public function __construct($command = null, $workingDir = null, $timeout = 60)
	{
		$this->defaults = array(
				self::ARG_WORKING_DIR => $workingDir,
				self::ARG_TIMEOUT     => $timeout,
				self::ARG_ENVIRONMENT => null,
				self::ARG_STDIN       => null,
				self::ARG_PROCESS_OPTIONS => array(),
				self::ARG_OUTPUT_HANDLER  => null,
			);

		// set default cmd if needed
		if($command) 
			$this->defaults[self::ARG_COMMAND] = $command;
	}

	/**
	 * doRun 
	 * 
	 * @param Task $task 
	 * @access protected
	 * @return void
	 */
	protected function doRun(Task $task)
	{
		$args = $task->getArguments();
		$args = array_replace($this->defaults, $args);

		if(!isset($args[self::ARG_COMMAND]))
			throw new \RuntimeException('Argument "cmd" is not specified to lauch the process.');

		$process = new Process(
				$args[self::ARG_COMMAND], 
				$args[self::ARG_WORKING_DIR],
				$args[self::ARG_STDIN],
				$args[self::ARG_TIMEOUT],
				$args[self::ARG_PROCESS_OPTIONS]
			);

		return $process->run($args[self::ARG_OUTPUT_HANDLER]);
	}

	public function setDefault($key, $value)
	{
		$this->defaults[$key] = $value;
	}

	public function getDefault($key)
	{
		return $this->defaults[$key];
	}
}

