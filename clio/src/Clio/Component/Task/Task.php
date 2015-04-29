<?php
namespace Clio\Component\Task;

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
	const STATUS_INIT      = 0b00000000;
	const STATUS_SCHEDULED = 0b00000001;
	const STATUS_STARTED   = 0b00000010;
	const STATUS_FINISHED  = 0b00000100;
	const STATUS_FAILURE   = 0b10000000;

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
	 * isStarted 
	 * 
	 * @access public
	 * @return void
	 */
	function isStarted();

	/**
	 * isFinished 
	 * 
	 * @access public
	 * @return void
	 */
	function isFinished();

	/**
	 * isSuccessed 
	 * 
	 * @access public
	 * @return void
	 */
	function isSuccessed();

	/**
	 * isFailed 
	 * 
	 * @access public
	 * @return void
	 */
	function isFailed();

	/**
	 * getResult 
	 * 
	 * @access public
	 * @return void
	 */
	function getResult();

	/**
	 * getError 
	 * 
	 * @access public
	 * @return void
	 */
	function getError();
}

