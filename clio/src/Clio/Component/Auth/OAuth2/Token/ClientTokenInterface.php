<?php
namespace Clio\Component\Auth\OAuth2\Token;

/**
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
interface ClientTokenInterface
{
	/**
	 * getAccessToken 
	 * 
	 * @access public
	 * @return void
	 */
	function getAccessToken();

	/**
	 * getRefreshToken 
	 * 
	 * @access public
	 * @return void
	 */
	function getRefreshToken();

	/**
	 * getScopes 
	 * 
	 * @access public
	 * @return void
	 */
	function getScopes();

	/**
	 * getTokenType 
	 * 
	 * @access public
	 * @return void
	 */
	function getTokenType();

	/**
	 * getExpiresIn 
	 * 
	 * @access public
	 * @return void
	 */
	function getExpiresIn();

}

