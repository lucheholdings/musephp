<?php
namespace Clio\Component\Util\Task;

/**
 * TaskQueue 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface TaskQueue
{
	/**
	 * enqueue 
	 * 
	 * @param Task $task 
	 * @access public
	 * @return void
	 */
	function enqueue($task);

	/**
	 * dequeue 
	 * 
	 * @access public
	 * @return Task
	 */
	function dequeue();
}

