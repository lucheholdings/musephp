<?php
namespace Clio\Component\Util\Task;

/**
 * Executor 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Executor
{
	/**
	 * run 
	 * 
	 * @param Task $task 
	 * @access public
	 * @return void
	 */
	function run(Task $task);
}
