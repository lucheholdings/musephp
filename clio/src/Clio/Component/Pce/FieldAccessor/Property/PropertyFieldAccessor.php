<?php
namespace Clio\Component\Pce\FieldAccessor\Property;

use Clio\Component\Pce\FieldAccessor\FieldAccessor;

/**
 * PropertyFieldAccessor 
 *   FieldAccessor for the specified field 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface PropertyFieldAccessor extends FieldAccessor
{
	/**
	 * getValue 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	function getValue($object);

	/**
	 * setValue 
	 * 
	 * @param mixed $object 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function setValue($object, $value);

	/**
	 * isValueNull
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	function isValueNull($object);

	/**
	 * clearValue 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	function clearValue($object);
}

