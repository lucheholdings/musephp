<?php
namespace Terpsichore\Client\Auth;

use Terpsichore\Client\Service\ClientService;
use Terpsichore\Client\Auth\Token;
/**
 * UserProvider
 *  Authentication Provider to provide authentication strategy
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface UserProvider extends ClientService
{
	/**
	 * userinfo
	 * 
	 * @access public
	 * @return mixed
	 */
	function userinfo();

	/**
	 * getAuthenticatedUser 
	 * 
	 * @access public
	 * @return User
	 */
	function getAuthenticatedUser();
}
