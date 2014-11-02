<?php
namespace Clio\Component\Util\Metadata;

/**
 * Mapping 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Mapping extends \Serializable
{
	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	function getName();

	/**
	 * getMetadata 
	 * 
	 * @access public
	 * @return void
	 */
	function getMetadata();

	/**
	 * clean 
	 *   Clean Mapping information 
	 * 
	 * @access public
	 * @return void
	 */
	function clean();

	/**
	 * __toString 
	 * 
	 * @access protected
	 * @return void
	 */
	function __toString();
}

