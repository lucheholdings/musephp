<?php
namespace Clio\Component\Util\Accessor\Schema;

use Clio\Component\Util\Accessor\Schema;

/**
 * AccessorFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface AccessorFactory 
{
	/**
	 * createSchemaAccessor 
	 * 
	 * @param mixed $schema 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	function createSchemaAccessor(Schema $schema, array $options = array());

	/**
	 * isSupportedSchema 
	 *    true if the schema is valid schema. 
	 *    false otherwise
	 * @param mixed $schema 
	 * @access public
	 * @return boolean
	 */
	function isSupportedSchema(Schema $schema);
}
