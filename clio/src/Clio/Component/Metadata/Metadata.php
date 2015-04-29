<?php
namespace Clio\Component\Metadata;

/**
 * Metadata 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Metadata 
{
	/**
	 * getName 
	 *   Name of Metadata.
     *   Either name of schema or field.
	 * @access public
	 * @return void
	 */
	function getName();

	/**
	 * __toString 
	 *   Alias of getName 
	 * @access protected
	 * @return void
	 */
	function __toString();
}

