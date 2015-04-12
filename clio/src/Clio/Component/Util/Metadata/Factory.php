<?php
namespace Clio\Component\Util\Metadata;

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
	 * createMetadata 
	 * 
	 * @access public
	 * @return Metadata 
	 */
	function createMetadata($type);
}

