<?php
namespace Clio\Component\Metadata;

/**
 * Factory 
 *    Create schema metadata.
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Factory
{
    /**
     * createSchemaMetadata 
     * 
     * @param mixed $type 
     * @access public
     * @return void
     */
	function createSchemaMetadata($type);
}

