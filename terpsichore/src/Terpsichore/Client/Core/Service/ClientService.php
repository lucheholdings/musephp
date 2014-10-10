<?php
namespace Terpsichore\Client\Service;

use Terpsichore\Client\Service;
use Terpsichore\Client\Connection;
use Terpsichore\Client\Connection\ConnectionContainer;
use Terpsichore\Client\Request;

/**
 * ClientService 
 *   Service uses Client.
 * 
 * @uses Service
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface ClientService extends Service, ConnectionContainer
{
	/**
	 * request 
	 * 
	 * @param Request $request 
	 * @access public
	 * @return void
	 */
	function request(Request $request);

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

