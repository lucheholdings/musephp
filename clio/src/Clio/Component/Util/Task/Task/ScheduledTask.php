<?php
namespace Clio\Component\Util\Task\Task;

use Clio\Component\Util\Task\Scheduler;

/**
 * ScheduledTask 
 * 
 * @uses Task
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ScheduledTask extends Task 
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
	 * setScheduler 
	 *   PEND when scheduler is initialized. 
	 * @param Scheduler $scheduler 
	 * @access public
	 * @return void
	 */
	public function setScheduler(Scheduler $scheduler, Task $task)
	{
		if($task instanceof ScheduledTask) {
			throw new \InvalidArgumentException(sprintf('The task "%s" is already scheduled on scheduler.', $task->getId()));
		}
		$this->task = $task;
		$this->scheduler = $scheduler;
		$this->status = self::STATUS_PENDING; 
	}

	/**
	 * getSheduler 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSheduler()
	{
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
		return ($this->status & self::STATUS_SCHEDULED) && 
			!($this->status | self::STATUS_STARTED);
	}
}

