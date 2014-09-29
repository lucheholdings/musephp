<?php
namespace Terpsichore\Core\Auth;

use Terpsichore\Core\Service\ClientService;
use Terpsichore\Core\Auth\Token;
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
	 * @return Token
	 */
	function authenticate(Token $token);

	/**
	 * getAuthenticatedUserInfo
	 *   Get Token User 
	 *
	 * @access public
	 * @return Auth\User
	 */
	function getAuthenticatedUser(Token $token);
}

