<?php
namespace Clio\Component\Util\Container\Queue;

use Clio\Component\Util\Container\Queue as QueueInterface;

/**
 * Queue
 *   Simple Queue implementatimon 
 * @uses QueueInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Queue implements QueueInterface
{
	/**
	 * values 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $values = array();

	/**
	 * getRaw 
	 * 
	 * @access public
	 * @return void
	 */
	public function getRaw()
	{
		return $values;
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
		array_push($this->values, $value);
	}

	/**
	 * dequeue 
	 * 
	 * @access public
	 * @return void
	 */
	public function dequeue()
	{
		return array_shift($this->values);
	}

	/**
	 * peek 
	 * 
	 * @access public
	 * @return void
	 */
	public function peek()
	{
		return reset($this->values);
	}

	/**
	 * count 
	 * 
	 * @access public
	 * @return void
	 */
	public function count()
	{
		return count($this->values);
	}

	public function getValues()
	{
		return $this->values;
	}
}

