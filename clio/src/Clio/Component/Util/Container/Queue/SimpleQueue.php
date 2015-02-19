<?php
namespace Clio\Component\Util\Container\Queue;

use Clio\Component\Util\Container\Queue as QueueInterface;

/**
 * SimpleQueue 
 * 
 * @uses QueueInterface
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SimpleQueue implements QueueInterface 
{
	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		$this->storage = new \SplQueue();
	}

	/**
	 * enqueue 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function enqueue($value)
	{
		$this->storage->enqueue($value);
	}

	/**
	 * dequeue 
	 * 
	 * @access public
	 * @return void
	 */
	public function dequeue()
	{
		return $this->storage->dequeue();
	}

	/**
	 * count 
	 * 
	 * @access public
	 * @return void
	 */
	public function count()
	{
		return count($this->storage);
	}

	public function begin()
	{
		$this->storage->rewind();
		return $this->storage->current();
	}

	public function end()
	{
		return $this->storage->top();
	}

	/**
	 * getIterator 
	 * 
	 * @access public
	 * @return void
	 */
	public function getIterator()
	{
		return $this->storage->getIterator();
	}
}

