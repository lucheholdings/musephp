<?php
namespace Clio\Component\Task\Task;

use Clio\Component\Task\Scheduler;
use Clio\Component\Task\Task as TaskInterface;

/**
 * ScheduledTask 
 * 
 * @uses Task
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ScheduledTask implements TaskInterface 
{
	/**
	 * id 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $id;

	/**
	 * scheduler 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $scheduler;

	/**
	 * task 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $task;

	/**
	 * __construct 
	 * 
	 * @param Scheduler $scheduler 
	 * @param Task $task 
	 * @access public
	 * @return void
	 */
	public function __construct(Scheduler $scheduler, Task $task)
	{
		if($task instanceof ScheduledTask) {
			throw new \InvalidArgumentException(sprintf('The task "%s" is already scheduled on scheduler.', $task->getId()));
		}
		$this->task = $task;
		$this->scheduler = $scheduler;
	}

	/**
	 * getSheduler 
	 * 
	 * @access public
	 * @return void
	 */
	public function getScheduler()
	{
		if(!$this->scheduler) {
			throw new \RuntimeException('ScheduledTask is not scheduled yet.');
		}
		return $this->scheduler;
	}
    
    /**
     * getId 
     * 
     * @access public
     * @return void
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * setId 
     * 
     * @param mixed $id 
     * @access public
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

	/**
	 * isPending 
	 * 
	 * @access public
	 * @return void
	 */
	public function isPending()
	{
		return !$this->task->isStarted();
	}

	public function wait()
	{
		$this->getScheduler()->waitFor($this);
	}

	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	public function getName()
	{
		return $this->task->getName();
	}

	public function setName($name)
	{
		throw new \RuntimeException('ScheduledTask cannot modify name.');
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
		throw new \RuntimeException('ScheduledTask cannot modify arguments.');
	}

	/**
	 * getArguments 
	 * 
	 * @access public
	 * @return void
	 */
	public function getArguments()
	{
		return $this->task->getArguments();
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
		throw new \RuntimeException('ScheduledTask cannot modify arguments.');
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
		throw new \RuntimeException('ScheduledTask cannot modify arguments.');
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
		return $this->task->getArgument($key);
	}

	/**
	 * isStarted 
	 * 
	 * @access public
	 * @return void
	 */
	public function isStarted()
	{
		return $this->task->isStarted;
	}

	/**
	 * isFinished 
	 * 
	 * @access public
	 * @return void
	 */
	public function isFinished()
	{
		return $this->task->isFinished;
	}

	/**
	 * isSuccessed 
	 * 
	 * @access public
	 * @return void
	 */
	public function isSuccessed()
	{
		return $this->task->isSuccessed();
	}

	/**
	 * isFailed 
	 * 
	 * @access public
	 * @return void
	 */
	public function isFailed()
	{
		return $this->task->isFailed();
	}

	/**
	 * start 
	 * 
	 * @access public
	 * @return void
	 */
	public function start()
	{
		$this->task->start();
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
		$this->task->setResult($result);
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
		$this->task->setError($error);
	}

	/**
	 * getResult 
	 * 
	 * @access public
	 * @return void
	 */
	public function getResult()
	{
		return $this->task->getResult();
	}

	/**
	 * getError 
	 * 
	 * @access public
	 * @return void
	 */
	public function getError()
	{
		return $this->task->getError();
	}
}

