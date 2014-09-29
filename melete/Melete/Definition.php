<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Melete;

interface Definition 
{
	/**
	 * getConfiguration 
	 * 
	 * @access public
	 * @return Symfony\Config\Node
	 */
	function getConfigTree();

	/**
	 * getClass
	 * 
	 * @access public
	 * @return ReflectionClass
	 */
	function getClass();
}

