<?php
namespace Clio\Component\Util\Accessor;

/**
 * Accessor 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Accessor
{
	const TYPE_GET    = 1;
	const TYPE_SET    = 2;
	const TYPE_EXISTS = 3;
	const TYPE_DELETE = 4;

	/**
	 * get 
	 * 
	 * @param mixed $container 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	function get($container, $field);

	/**
	 * set 
	 * 
	 * @param mixed $container 
	 * @param mixed $field 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function set($container, $field, $value);

	/**
	 * isExists 
	 *   Check the value existed with the specified field on container
	 * 
	 * @param mixed $container 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	function isExists($container, $field);

	/**
	 * delete
	 *   Delete the field from the container
	 * @param mixed $container 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	function delete($container, $field);

	/**
	 * isSupportMethod 
	 * 
	 * @param mixed $container 
	 * @param mixed $field 
	 * @param mixed $methodType 
	 * @access public
	 * @return void
	 */
	function isSupportMethod($container, $field, $methodType);

	/**
	 * getFieldNames 
	 * 
	 * @access public
	 * @return void
	 */
	function getFieldNames($container = null);

	/**
	 * getFieldValues 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	function getFieldValues($container);
}

