<?php
namespace Clio\Component\Pce\Metadata;

/**
 * MappingFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface MappingFactory
{
	/**
	 * createMapping 
	 * 
	 * @param Metadata $metadata 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	function createMapping(Metadata $metadata, array $options = array());
}

