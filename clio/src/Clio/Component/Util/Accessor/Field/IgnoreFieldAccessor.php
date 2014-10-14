<?php
namespace Clio\Component\Util\Accessor\Field;

/**
 * IgnoreFieldAccessor 
 * 
 * @uses AbstractFieldAccessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class IgnoreFieldAccessor extends AbstractFieldAccessor 
{
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

