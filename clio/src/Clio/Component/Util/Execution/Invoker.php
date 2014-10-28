<?php
namespace Clio\Component\Util\Execution;

/**
 * Invoker 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class Invoker implements Invokable 
{
	/**
	 * invoke 
	 * 
	 * @access public
	 * @return void
	 */
	public function invoke()
	{
		return $this->doInvokeArgs(func_get_args());
	}
	
	/**
	 * invokeArgs 
	 * 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function invokeArgs(array $args = array())
	{
		return $this->doInvokeArgs($args);
	}

	/**
	 * __invoke 
	 * 
	 * @access public
	 * @return void
	 */
	public function __invoke()
	{
		return $this->doInvokeArgs(func_get_args());
	}

	/**
	 * doInvokeArgs 
	 * 
	 * @param array $args 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function doInvokeArgs(array $args);
}

