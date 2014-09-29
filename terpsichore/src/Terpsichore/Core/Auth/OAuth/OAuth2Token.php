<?php
namespace Terpsichore\Core\Auth\OAuth;

use Terpsichore\Core\Auth\Token;

/**
 * OAuth2Token 
 * 
 * @uses Token
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface OAuth2Token extends OAuthToken
{
	/**
	 * getType 
	 *   Get Token Type 
	 * @access public
	 * @return void
	 */
	function getType();

	/**
	 * getRefreshToken 
	 * 
	 * @access public
	 * @return void
	 */
	function getRefreshToken();
}

