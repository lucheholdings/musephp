<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Component\Pattern\Factory;

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
	 * createArgs 
	 * 
	 * @param string $type
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	function createByTypeArgs($type, array $args = array());
}

