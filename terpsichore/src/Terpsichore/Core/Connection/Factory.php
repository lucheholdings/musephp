<?php
namespace Terpsichore\Core\Connection;

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
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	function createConnection(array $options = array());
}

