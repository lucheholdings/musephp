<?php
namespace Terpsichore\Server\Auth\OAuth\Token\Provider;

/**
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
interface AuthorizationCodeGrantTokenProviderInterface extends TokenProviderInterface
{
	/**
	 * getTokenWithAuthorizationCodeGrant 
	 * 
	 * @param mixed $code 
	 * @access public
	 * @return ClientTokenInterface
	 */
	function getTokenWithAuthorizationCodeGrant($code, array $scopes = array(), $configs = array());
}

