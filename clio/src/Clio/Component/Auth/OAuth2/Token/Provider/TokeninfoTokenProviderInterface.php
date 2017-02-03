<?php
namespace Clio\Component\Auth\OAuth2\Token\Provider;

/**
 * TokeninfoTokenProviderInterface 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface TokeninfoTokenProviderInterface  
{
	/**
	 * getTokenWithTokeninfo 
	 * 
	 * @param mixed $token 
	 * @access public
	 * @return void
	 */
	function getTokenWithTokeninfo($token);
}

