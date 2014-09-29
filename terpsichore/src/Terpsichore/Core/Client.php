<?php
namespace Terpsichore\Core;

use Terpsichore\Core\Auth\Provider as AuthenticationProvider;
use Terpsichore\Core\Client\Request;
/**
 * Client 
 *   Client Interface is to simplify the HttpClient to use on Terpsichore.
 *   We do not implement HttpClient itself.
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Client
{
	/**
	 * send 
	 *   Send the request and get the response as Array.
	 *   If the response is an Object, then plz parse them
	 * 
	 * @access public
	 * @return array
	 */
	function send(Request $request);
}

