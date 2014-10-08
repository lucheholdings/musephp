<?php
namespace Clio\Component\Pattern\Factory;

/**
 * TypedFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface TypedFactory 
{
	/**
	 * createType 
	 *    
	 * @param string $type 
	 * @param [...] arguments passing to construct
	 * @access public
	 * @return void
	 */
	function createByType($type);

	/**
	 * createByTypeArgs 
	 * 
	 * @param mixed $type 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	function createByTypeArgs($type, array $args = array());
}

