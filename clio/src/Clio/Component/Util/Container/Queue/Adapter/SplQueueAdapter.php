<?php
namespace Clio\Component\Util\Container\Queue\Adapter;

use Clio\Component\Util\Container\Queue as QueueInterface;

/**
 * SplQueueAdapter 
 * 
 * @uses QueueInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SplQueueAdapter implements QueueInterface
{
	/**
	 * splQueue 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $splQueue;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(\SplQueue $sqlQueue)
	{
		$this->splQueue = $splQueue;
	}
    
    /**
     * Get splQueue.
     *
     * @access public
     * @return splQueue
     */
    public function getSplQueue()
    {
        return $this->splQueue;
    }
    
	/**
	 * peek 
	 * 
	 * @access public
	 * @return void
	 */
	public function peek()
	{
		return $this->splQueue->top();
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
		$this->splQueue->enqueue($value);
	}

	/**
	 * dequeue 
	 * 
	 * @access public
	 * @return void
	 */
	public function dequeue()
	{
		return $this->splQueue->dequeue();
	}
}

