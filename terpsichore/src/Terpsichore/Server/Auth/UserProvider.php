<?php
namespace Terpsichore\Server\Auth;

/**
 * UserProvider 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface UserProvider 
{
	/**
	 * findUserByToken 
	 * 
	 * @param Token $token 
	 * @access public
	 * @return void
	 */
	function findUserByToken(Token $token);
}
