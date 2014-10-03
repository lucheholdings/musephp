<?php
namespace Terpsichore\Core\Connection;

use Terpsichore\Core\Connection;

/**
 * ConnectionContainer 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface ConnectionContainer 
{
	/**
	 * setConnection 
	 * 
	 * @param Connection $connection 
	 * @access public
	 * @return void
	 */
	function setConnection(Connection $connection);

	/**
	 * getConnection 
	 * 
	 * @access public
	 * @return void
	 */
	function getConnection();
}

