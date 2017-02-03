<?php
namespace Clio\Component\Pce\Metadata;

/**
 * MappableMetadata
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface MappableMetadata
{
	/**
	 * getMappings 
	 * 
	 * @access public
	 * @return void
	 */
	function getMappings();

	/**
	 * getMapping 
	 * 
	 * @param mixed $alias 
	 * @access public
	 * @return void
	 */
	function getMapping($alias);

	/**
	 * hasMapping 
	 * 
	 * @param mixed $alias 
	 * @access public
	 * @return void
	 */
	function hasMapping($alias);
}

