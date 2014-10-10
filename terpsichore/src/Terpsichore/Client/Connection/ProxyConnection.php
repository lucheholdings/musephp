<?php
namespace Terpsichore\Client\Connection;

use Terpsichore\Client\Connection;

/**
 * ProxyConnection 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface ProxyConnection extends Connection
{
	/**
	 * getConnection 
	 * 
	 * @access public
	 * @return void
	 */
	function getConnection();
}

