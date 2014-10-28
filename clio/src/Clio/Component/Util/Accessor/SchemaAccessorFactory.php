<?php
namespace Clio\Component\Util\Accessor;

/**
 * SchemaAccessorFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface SchemaAccessorFactory
{
	/**
	 * createSchemaAccessor 
	 * 
	 * @param mixed $schema 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	function createSchemaAccessor($schema, array $options = array());

	/**
	 * isSupportedSchema 
	 *    true if the schema is valid schema. 
	 *    false otherwise
	 * @param mixed $schema 
	 * @access public
	 * @return boolean
	 */
	function isSupportedSchema($schema);
}
