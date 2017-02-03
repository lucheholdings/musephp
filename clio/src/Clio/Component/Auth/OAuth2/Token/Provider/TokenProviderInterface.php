<?php
namespace Clio\Component\Auth\OAuth2\Token\Provider;

use Clio\Component\Auth\OAuth2\Token\ClientTokenInterface;

/**
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
interface TokenProviderInterface
{
	/**
	 * getToken 
	 * 
	 * @param array $configs 
	 * @access public
	 * @return ClientTokenInterface
	 */
	function getToken($configs = array());
}

