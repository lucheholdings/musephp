<?php
namespace Clio\Component\Util\Container\Queue;

use Clio\Component\Util\Container\Queue as QueueInterface;

use Clio\Component\Util\Container\StoragedContainer;
use Clio\Component\Util\Container\Storage,
	Clio\Component\Util\Container\Storage\FIFOStorage,
	Clio\Component\Util\Container\Storage\DirectionalStorage
;
use Clio\Component\Util\Container\Storage\FIFO;

/**
 * StoragedQueue 
 *   Queue implementation with Storage Strategy.
 * @uses QueueInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class StoragedQueue extends StoragedContainer implements QueueInterface
{
	/**
	 * __construct 
	 * 
	 * @param Storage $storage 
	 * @access public
	 * @return void
	 */
	public function __construct(Storage $storage)
	{
		if(!$storage instanceof FIFOStorage) {
			if($storage instanceof DirectionalStorage) {
				$storage = new FIFO\DirectionalStorageAdapter($storage);
			} else {
				throw new \Clio\Component\Exception\InvalidArgumentException(sprintf('Storage has to be an instanceof Directional or FIFO Storage'));
			}
		} 

		parent::__construct($storage);
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
		// 
		$this->getStorage()->enqueue($value);
	}

	/**
	 * dequeue 
	 * 
	 * @access public
	 * @return void
	 */
	public function dequeue()
	{
		return $this->getStorage()->dequeue();
	}

	/**
	 * peek 
	 * 
	 * @access public
	 * @return void
	 */
	public function peek()
	{
		return $this->getStorage()->peek();
	}

	/**
	 * count 
	 * 
	 * @access public
	 * @return void
	 */
	public function count()
	{
		return $this->getStorage()->count();
	}
}

