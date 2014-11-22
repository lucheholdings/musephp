<?php
namespace Clio\Component\Util\Metadata;

/**
 * SchemaMetadata 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface SchemaMetadata extends Metadata, \Serializable
{
	/**
	 * getFields 
	 *    
	 * @access public
	 * @return array<FieldMetadata>
	 */
	function getFields();

	/**
	 * isSchemaData 
	 *   Check the data is schema data or not. 
	 * @param mixed $data 
	 * @access public
	 * @return boolean
	 */
	function isSchemaData($data);
}

