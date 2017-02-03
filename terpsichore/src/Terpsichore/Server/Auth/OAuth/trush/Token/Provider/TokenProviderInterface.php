<?php
namespace Terpsichore\Server\Auth\OAuth\Token\Provider;

use Terpsichore\Server\Auth\OAuth\Token\ClientTokenInterface;

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

