<?php
namespace Calliope\Framework\Core\Tool;

/**
 * AbstractTool 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractTool
{

	/**
	 * doInvoke 
	 * 
	 * @param array $args 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function doInvoke(array $args);

	/**
	 * invoke 
	 * 
	 * @access public
	 * @return void
	 */
	public function invoke()
	{
		return $this->doInvoke(func_get_args());
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
		return $this->doInvoke($args);
	}

	/**
	 * __invoke 
	 * 
	 * @access public
	 * @return void
	 */
	public function __invoke()
	{
		return $this->doInvoke(func_get_args());
	}
}

