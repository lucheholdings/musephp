<?php
namespace Clio\Component\Util\Task;

/**
 * Task 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Task
{
	/**
	 * getName 
	 *   Get TaskName 
	 * @access public
	 * @return void
	 */
	function getName();

	/**
	 * getArguments 
	 * 
	 * @access public
	 * @return array
	 */
	function getArguments();

	/**
	 * wait 
	 *   Wait until task done
	 * @access public
	 * @return void
	 */
	function wait();

	/**
	 * getResponse 
	 *   Get the task response. If task is not done yet, wait until it is done.
	 *   
	 * @access public
	 * @return void
	 */
	function getResponse();
}

