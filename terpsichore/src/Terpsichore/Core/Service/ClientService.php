<?php
namespace Terpsichore\Core\Service;

use Terpsichore\Core\Service;

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
interface ClientService extends Service
{
	/**
	 * getClient 
	 * 
	 * @access public
	 * @return void
	 */
	function getClient();
}

