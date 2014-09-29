<?php
namespace Clio\Component\Pattern\Factory;

/**
 * Factory 
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
	function createArgs(array $args);
}

