<?php
namespace Clio\Component\Util\Task\Task;

use Clio\Component\Util\Task\Task as TaskInterface;

/**
 * Task 
 * 
 * @uses TaskInterface
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Task implements TaskInterface 
{
	/**
	 * name 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $name;

	/**
	 * args 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $args;

	/**
	 * status 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $status;

	/**
	 * result 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $result;

	/**
	 * __construct 
	 * 
	 * @param mixed $status 
	 * @access public
	 * @return void
	 */
	public function __construct($name, array $args = array())
	{
		$this->status = self::STATUS_INIT;

		$this->name = $name;
		$this->args = $args;
	}

	/**
	 * setName 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * setArguments 
	 * 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function setArguments(array $args)
	{
		$this->args = $args;
	}

	/**
	 * getArguments 
	 * 
	 * @access public
	 * @return void
	 */
	public function getArguments()
	{
		return $this->args;
	}

	/**
	 * setArgument 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function setArgument($key, $value)
	{
		$this->args[$key] = $value;
	}

	/**
	 * addArgument 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function addArgument($value)
	{
		$this->args[] = $value;
	}

	/**
	 * getArgument 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function getArgument($key)
	{
		return $this->args[$key];
	}

	/**
	 * isStarted 
	 * 
	 * @access public
	 * @return void
	 */
	public function isStarted()
	{
		return (bool)($this->status & self::STATUS_STARTED);
	}

	/**
	 * isFinished 
	 * 
	 * @access public
	 * @return void
	 */
	public function isFinished()
	{
		return (bool)($this->status & self::STATUS_FINISHED);
	}

	/**
	 * isSuccessed 
	 * 
	 * @access public
	 * @return void
	 */
	public function isSuccessed()
	{
		if(!($this->status & self::STATUS_FINISHED)) {
			throw new \RuntimeException('Task is not finished yet.');
		}
		return (bool)!($this->status & self::STATUS_FAILURE);
	}

	/**
	 * isFailed 
	 * 
	 * @access public
	 * @return void
	 */
	public function isFailed()
	{
		if(!($this->status & self::STATUS_FINISHED)) {
			throw new \RuntimeException('Task is not finished yet.');
		}
		return (bool)($this->status & self::STATUS_FAILURE);
	}

	/**
	 * start 
	 * 
	 * @access public
	 * @return void
	 */
	public function start()
	{
		if($this->status & self::STATUS_STARTED) {
			throw new \RuntimeException('Task already started.');
		}
		$this->status |= self::STATUS_STARTED;
	}

	/**
	 * setResult 
	 * 
	 * @param mixed $result 
	 * @access public
	 * @return void
	 */
	public function setResult($result)
	{
		if($this->status & self::STATUS_FINISHED) {
			throw new \RuntimeException('Task already finished.');
		}
		$this->result = $result;
		$this->status |= self::STATUS_FINISHED;
	}

	/**
	 * setError 
	 * 
	 * @param mixed $error 
	 * @access public
	 * @return void
	 */
	public function setError($error)
	{
		if($this->status & self::STATUS_FINISHED) {
			throw new \RuntimeException('Task already finished.');
		}
		$this->result = $error;
		$this->status |= self::STATUS_FINISHED | self::STATUS_FAILURE;
	}

	/**
	 * getResult 
	 * 
	 * @access public
	 * @return void
	 */
	public function getResult()
	{
		if($this->status & self::STATUS_FAILURE) {
			throw new \RuntimeException('Task is not successed.');
		}
		return $this->result;
	}

	/**
	 * getError 
	 * 
	 * @access public
	 * @return void
	 */
	public function getError()
	{
		if(0 == ($this->status & self::STATUS_FAILURE)) {
			throw new \RuntimeException('Task is not failed.');
		}
		return $this->result;
	}
}

