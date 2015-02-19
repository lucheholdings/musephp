<?php
namespace Clio\Component\Util\Container\Stack;

use Clio\Component\Util\Container\Stack as StackInterface;

/**
 * SimpleStack 
 * 
 * @uses StackInterface
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SimpleStack implements StackInterface 
{
	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		$this->storage = new \SplStack();
	}

	/**
	 * push 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function push($value)
	{
		$this->storage->push($value);
	}

	/**
	 * pop 
	 * 
	 * @access public
	 * @return void
	 */
	public function pop()
	{
		return $this->storage->pop();
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

	public function top()
	{
		return $this->storage->top();
	}

	public function bottom()
	{
		return $this->storage->bottom();
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

