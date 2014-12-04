<?php
namespace Calliope\Core\Connection;

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
	 * createConnection 
	 * 
	 * @param mixed $connectTo 
	 * @access public
	 * @return void
	 */
	function createConnection($connectTo, array $options = array());
}

