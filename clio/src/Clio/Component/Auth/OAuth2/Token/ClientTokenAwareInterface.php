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
interface ClientTokenAwareInterface
{
	/**
	 * getOAuthToken
	 * 
	 * @access public
	 * @return ClientTokenInterface
	 */
	function getOAuthToken();
}

