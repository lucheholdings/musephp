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
interface SchemaMetadata extends Metadata
{
	/**
	 * getFields 
	 *    
	 * @access public
	 * @return array<FieldMetadata>
	 */
	function getFields();
}

