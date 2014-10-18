<?php
namespace Clio\Component\Util\Accessor\Field;

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
	function createFieldAccessor($schema, $field, array $options = array());

	/**
	 * isSupportedSchemaField 
	 * 
	 * @param mixed $schema 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	function isSupportedSchemaField($schema, $field);
}

