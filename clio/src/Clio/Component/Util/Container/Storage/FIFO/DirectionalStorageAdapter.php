<?php
namespace Clio\Component\Util\Container\Storage\FIFO;

use Clio\Component\Util\Container\Storage\StorageAdapter;
use Clio\Component\Util\Container\Storage\FIFOStorage,
	Clio\Component\Util\Container\Storage\DirectionalStorage;

/**
 * DirectionalStorageAdapter 
 * 
 * @uses FIFOStorage
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DirectionalStorageAdapter extends StorageAdapter implements FIFOStorage
{

	/**
	 * __construct 
	 * 
	 * @param OriginalStorage $originalStorage 
	 * @access public
	 * @return void
	 */
	public function __construct(DirectionalStorage $originalStorage)
	{
		parent::__construct($originalStorage);
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
		return $this->getOriginalStorage()->addLast($value);
	}

	/**
	 * dequeue 
	 * 
	 * @access public
	 * @return void
	 */
	public function dequeue()
	{
		return $this->getOriginalStorage()->removeFirst();
	}

	public function peek()
	{
		return $this->getOriginalStorage()->first();
	}
}

