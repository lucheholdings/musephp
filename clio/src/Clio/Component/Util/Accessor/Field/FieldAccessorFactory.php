<?php
namespace Clio\Component\Util\Accessor\Field;

use Clio\Component\Util\Accessor\Field;

/**
 * FieldAccessorFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface FieldAccessorFactory
{
	/**
	 * createFieldAccessor 
	 * 
	 * @param mixed $schema 
	 * @param mixed $field 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	function createFieldAccessor(Field $field, array $options = array());

	/**
	 * isSupportedField 
	 * 
	 * @param mixed $schema 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	function isSupportedField(Field $field);
}

