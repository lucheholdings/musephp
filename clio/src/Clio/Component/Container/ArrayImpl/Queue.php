<?php
namespace Clio\Component\Container\ArrayImpl;

use Clio\Component\Container\Queue as QueueInterface;

/**
 * Queue 
 * 
 * @uses QueueInterface
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Queue extends AbstractContainer implements QueueInterface 
{
	/**
	 * enqueue 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function enqueue($value)
	{
		array_push($this->values, $value);
        return $this;
	}

	/**
	 * dequeue 
	 * 
	 * @access public
	 * @return void
	 */
	public function dequeue()
	{
        if(empty($this->values)) {
            throw new ContainerException\EmptyException('Empty Queue');
        }
        return array_shift($this->values);
	}

    /**
     * begin 
     * 
     * @access public
     * @return void
     */
	public function begin()
	{
        return reset($this->values);
	}

    /**
     * end 
     * 
     * @access public
     * @return void
     */
	public function end()
	{
		return end($this->values);
	}
}

