<?php
namespace Clio\Component\Util\Task\Executor;

use Clio\Component\Util\Task\Task;

/**
 * ClosureExecutor 
 * 
 * @uses NamedExecutor
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ClosureExecutor extends NamedExecutor 
{
	/**
	 * closure 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $closure;

	/**
	 * __construct 
	 * 
	 * @param mixed $name 
	 * @param \Closure $closure 
	 * @access public
	 * @return void
	 */
	public function __construct($name, \Closure $closure)
	{
		parent::__construct($name);
		$this->closure = $closure;
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
		$closure = $this->closure;
		return $closure($task);
	}
}

