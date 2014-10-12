<?php
namespace Terpsichore\Client\Auth;

/**
 * Token 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Token 
{
	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	function getName();

	/**
	 * getProvider 
	 *   AuthenticationProvider related with this token 
	 * @access public
	 * @return void
	 */
	function getProvider();

	/**
	 * isAuthenticated 
	 *   True if authenticated, false other.
	 * @access public
	 * @return void
	 */
	function isAuthenticated();
}

