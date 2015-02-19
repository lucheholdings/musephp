<?php
namespace Clio\Component\Util\Task\Executor;

/**
 * NamedExecutor 
 * 
 * @uses AbstractExecutor
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class NamedExecutor extends AbstractExecutor
{
	/**
	 * taskName 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $taskName;

	/**
	 * __construct 
	 * 
	 * @param mixed $taskName 
	 * @access public
	 * @return void
	 */
	public function __construct($taskName)
	{
		$this->taskName = $taskName;
	}
    
    /**
     * getTaskName 
     * 
     * @access public
     * @return void
     */
    public function getTaskName()
    {
        return $this->taskName;
    }
}

