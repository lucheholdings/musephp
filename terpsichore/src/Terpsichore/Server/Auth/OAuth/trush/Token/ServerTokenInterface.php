<?php
namespace Terpsichore\Server\Auth\OAuth\Token;

/**
 * ServerTokenInterface
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
interface ServerTokenInterface 
{
	/**
	 * getClientId 
	 * 
	 * @access public
	 * @return void
	 */
	function getClientId();

	/**
	 * getToken 
	 *   Get Token String
	 * @access public
	 * @return string
	 */
	function getToken();

	/**
	 * getExpiresIn 
	 * 
	 * @access public
	 * @return void
	 */
	function getExpiresIn();

	/**
	 * getScope 
	 * 
	 * @access public
	 * @return array
	 */
	function getScopes();
}
