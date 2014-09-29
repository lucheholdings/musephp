<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Core\Auth\Token;
use Terpsichore\Core\Auth\Token;

/**
 * UserToken 
 * 
 * @uses Token
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface UserToken extends Token 
{
	/**
	 * getUser 
	 * 
	 * @access public
	 * @return void
	 */
	function getUser();
}

