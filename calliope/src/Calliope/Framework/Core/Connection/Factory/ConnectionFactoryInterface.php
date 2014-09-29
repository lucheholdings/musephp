<?php
namespace Calliope\Framework\Core\Connection\Factory;

/**
 * ConnectionFactoryInterface 
 *   
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface ConnectionFactoryInterface 
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

