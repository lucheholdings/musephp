<?php
namespace Clio\Component\Pattern\Factory;

/**
 * Factory 
 *   Create Specified class instance. 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Factory 
{
	/**
	 * create 
	 * 
	 * @param $args... Arguments passing to the class constructor
	 * @access public
	 * @return void
	 */
	function create();

	/**
	 * createArgs 
	 * 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	function createArgs(array $args = array());

	/**
	 * isSupportedArgs 
	 * 
	 * @param array $args 
	 * @access public
	 * @return bool support to create with the args or not.
	 */
	function isSupportedArgs(array $args = array());
}

