<?php
namespace Clio\Component\Auth\OAuth2\Token\Provider;

/**
 * TokenInfoProviderInterface 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface TokenInfoProviderInterface 
{
	/**
	 * getTokenInfo 
	 * 
	 * @param mixed $token 
	 * @access public
	 * @return void
	 */
	function getTokenInfo($token);
}

