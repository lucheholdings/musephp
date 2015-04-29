<?php
namespace Clio\Component\Metadata;

/**
 * Mapping 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Mapping 
{
	/**
	 * getName 
	 *   Name of the mapping.
     *  
	 * @access public
	 * @return string 
	 */
	function getName();

	/**
	 * getMetadata 
	 *   
	 * @access public
	 * @return Metadata 
	 */
	function getMetadata();

	/**
	 * __toString 
	 *   Alias of getName 
	 * @access protected
	 * @return void
	 */
	function __toString();
}

