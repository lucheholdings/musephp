<?php
namespace Terpsichore\Core\Auth;

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
	 * 
	 * @access public
	 * @return void
	 */
	function getProvider();

	/**
	 * isAuthenticated 
	 * 
	 * @access public
	 * @return void
	 */
	function isAuthenticated();
}

