<?php
namespace Terpsichore\Client\Auth\Token;

use Terpsichore\Client\Auth\Token;

/**
 * ProxyToken 
 * 
 * @uses Token
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface ProxyToken extends Token
{
	/**
	 * getToken 
	 * 
	 * @access public
	 * @return Token
	 */
	function getToken();
}

