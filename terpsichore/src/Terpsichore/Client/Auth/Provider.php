<?php
namespace Terpsichore\Client\Auth;

use Terpsichore\Client\Service\ClientService;
use Terpsichore\Client\Auth\Token;
/**
 * Provider
 *  Authentication Provider to provide authentication strategy
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Provider extends ClientService
{
	/**
	 * authenticate 
	 * 
	 * @access public
	 * @return void
	 */
	function authenticate(Token $token);
}

