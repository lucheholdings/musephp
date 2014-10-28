<?php
namespace Clio\Component\Util\Metadata;

/**
 * SchemaMetadataRegistry 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface SchemaMetadataRegistry 
{
	/**
	 * getSchemaMetadata 
	 * 
	 * @param mixed $schemaName 
	 * @access public
	 * @return void
	 */
	public function getSchemaMetadata($schemaName);
}

