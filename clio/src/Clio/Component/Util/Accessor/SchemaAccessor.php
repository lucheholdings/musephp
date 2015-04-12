<?php
namespace Clio\Component\Util\Accessor;

use Clio\Component\Util\Accessor\Field\MultiFieldAccessor;
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
interface SchemaAccessor extends Accessor
{
	/**
	 * getSchema 
	 * 
	 * @access public
	 * @return void
	 */
	function getSchema();

	/**
	 * createDataAccessor 
	 *   Create DataAccessor which specified current Schema to access. 
	 * @access public
	 * @return SchemaDataAccessor
	 */
	function createDataAccessor($data);
}

