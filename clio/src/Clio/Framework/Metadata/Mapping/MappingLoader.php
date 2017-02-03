<?php
namespace Clio\Framework\Metadata\Mapping;

/**
 * MappingLoader
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface MappingLoader
{
	/**
	 * loadMapping 
	 * 
	 * @param ClassMetadata $metadata 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	function loadMapping(ClassMetadata $metadata, array $options = array());
}

