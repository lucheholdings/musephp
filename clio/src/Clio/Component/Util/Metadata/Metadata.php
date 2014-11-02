<?php
namespace Clio\Component\Util\Metadata;

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
	 * 
	 * @access public
	 * @return void
	 */
	function getName();

	/**
	 * __toString 
	 * 
	 * @access protected
	 * @return void
	 */
	function __toString();

	/**
	 * clean 
	 *   Clean Metadata.
	 *   This method is called after create complete metadata.
	 *   We clean each Mapping as well
	 * 
	 * @access public
	 * @return void
	 */
	function clean();
}

