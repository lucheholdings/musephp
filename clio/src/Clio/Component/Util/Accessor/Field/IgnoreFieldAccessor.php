<?php
namespace Clio\Component\Util\Accessor\Field;

/**
 * IgnoreFieldAccessor 
 * 
 * @uses AbstractSingleFieldAccessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class IgnoreFieldAccessor extends AbstractSingleFieldAccessor 
{

	/**
	 * get 
	 * 
	 * @param mixed $container 
	 * @access public
	 * @return void
	 */
	public function get($container)
	{
		return null;
	}

	/**
	 * set 
	 * 
	 * @param mixed $container 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($container, $value)
	{
		return $this;
	}

	/**
	 * isSupportedMethod 
	 * 
	 * @param mixed $container 
	 * @param mixed $field 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function isSupportedMethod($container, $field, $type)
	{
		return true;
	}
}

