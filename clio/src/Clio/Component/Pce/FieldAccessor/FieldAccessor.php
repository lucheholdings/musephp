<?php
namespace Clio\Component\Pce\FieldAccessor;

/**
 * FieldAccessor
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface FieldAccessor
{
	const METHOD_TYPE_GET   = 'get';
	const METHOD_TYPE_SET   = 'set';
	const METHOD_TYPE_CLEAR = 'clear';
	const METHOD_TYPE_IS_NULL  = 'is_null';

	/**
	 * get 
	 * 
	 * @param mixed $object 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	function get($object, $field);

	/**
	 * set 
	 * 
	 * @param mixed $object 
	 * @param mixed $field 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function set($object, $field, $value);

	/**
	 * isNull 
	 * 
	 * @param mixed $object 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	function isNull($object, $field);

	/**
	 * clear
	 * 
	 * @param mixed $object 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	function clear($object, $field);

	/**
	 * isSupportMethod 
	 * 
	 * @param mixed $object 
	 * @param mixed $field 
	 * @param mixed $methodType 
	 * @access public
	 * @return void
	 */
	function isSupportMethod($object, $field, $methodType);

	/**
	 * getFieldNames 
	 * 
	 * @access public
	 * @return void
	 */
	function getFieldNames($object = null);

	/**
	 * getFields 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	function getFields($object);
}

