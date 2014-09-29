<?php
namespace Clio\Component\Util\Execution;

/**
 * ClosureInvoker 
 * 
 * @uses Invoker
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ClosureInvoker extends Invoker 
{
	/**
	 * closure 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $closure;

	/**
	 * __construct 
	 * 
	 * @param \Closure $closure 
	 * @access public
	 * @return void
	 */
	public function __construct(\Closure $closure)
	{
		$this->closure = $closure;
	}

	/**
	 * doInvoke 
	 * 
	 * @param array $args 
	 * @access protected
	 * @return void
	 */
	protected function doInvoke(array $args)
	{
		return call_user_func_array($this->closure, $args);
	}
}

