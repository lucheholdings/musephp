<?php
namespace Clio\Component\Util\Accessor;

/**
 * SchemaAccessor 
 *    SchemaAccessor is not for a specified data, 
 *    but for a specified schema.
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface SchemaAccessor
{
	const TYPE_GET    = 1;
	const TYPE_SET    = 2;
	const TYPE_EMPTY  = 3;
	const TYPE_CLEAR  = 4;

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
	 * isNull 
	 *   Check the value existed with the specified field on container
	 * 
	 * @param mixed $container 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	function isNull($container, $field);

	/**
	 * clear
	 *   Clear the field from the container
	 * 
	 * @param mixed $container 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	function clear($container, $field);

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

	/**
	 * existsField 
	 * 
	 * @param mixed $container 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	function existsField($container, $field);
}

