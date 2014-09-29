<?php
namespace Clio\Component\Util\Execution;

/**
 * Invoke 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Invoke 
{
	/**
	 * __construct 
	 * 
	 * @param Invoker $invoker 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function __construct(Invoker $invoker, array $args = array())
	{
		$this->invoker = $invoker;
		$this->args = $args;
	}

	/**
	 * invoke 
	 * 
	 * @access public
	 * @return void
	 */
	public function invoke()
	{
		return $this->invoker->invokeArgs($this->args);
	}
}

