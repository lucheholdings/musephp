<?php
namespace Clio\Component\Util\Accessor\Field;

/**
 * FieldAccessor 
 *   FieldAccessor is an accessor for specified field on container 
 * @uses Accessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface FieldAccessor 
{
	const TYPE_GET      = 1;
	const TYPE_SET      = 2;
	const TYPE_IS_EMPTY = 3;
	const TYPE_CLEAR    = 4;

	/**
	 * get 
	 * 
	 * @param mixed $container 
	 * @access public
	 * @return void
	 */
	function get($container);

	/**
	 * set 
	 * 
	 * @param mixed $container 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function set($container, $value);

	/**
	 * isEmpty
	 * 
	 * @param mixed $container 
	 * @access public
	 * @return void
	 */
	function isEmpty($container);

	/**
	 * clear
	 * 
	 * @param mixed $container 
	 * @access public
	 * @return void
	 */
	function clear($container);

	/**
	 * getFieldName 
	 * 
	 * @access public
	 * @return void
	 */
	function getFieldName();
}

