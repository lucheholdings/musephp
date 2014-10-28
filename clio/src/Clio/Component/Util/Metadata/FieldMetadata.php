<?php
namespace Clio\Component\Util\Metadata;

/**
 * FieldMetadata 
 * 
 * @uses Metadata
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface FieldMetadata extends Metadata, \Serializable
{
	/**
	 * getType 
	 * 
	 * @access public
	 * @return void
	 */
	function getType();
}

