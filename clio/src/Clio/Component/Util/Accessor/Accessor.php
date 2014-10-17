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
	const ACCESS_GET = 1;
	const ACCESS_SET = 2;

	/**
	 * get 
	 * 
	 * @param mixed $container 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	function get($field);

	/**
	 * set 
	 * 
	 * @param mixed $container 
	 * @param mixed $field 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function set($field, $value);

	/**
	 * isNull 
	 *   Check the value existed with the specified field on container
	 * 
	 * @param mixed $container 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	function isNull($field);

	/**
	 * clear
	 *   Clear the field from the container
	 * 
	 * @param mixed $container 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	function clear($field);

	/**
	 * existsField 
	 * 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	function existsField($field);

	/**
	 * isSupportMethod 
	 * 
	 * @param mixed $container 
	 * @param mixed $field 
	 * @param mixed $methodType 
	 * @access public
	 * @return void
	 */
	function isSupportMethod($field, $methodType);

	/**
	 * getFieldNames 
	 * 
	 * @access public
	 * @return void
	 */
	function getFieldNames();

	/**
	 * getFieldValues 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	function getFieldValues();

	/**
	 * getData 
	 *   Get target data 
	 * @access public
	 * @return void
	 */
	function getData();
}

