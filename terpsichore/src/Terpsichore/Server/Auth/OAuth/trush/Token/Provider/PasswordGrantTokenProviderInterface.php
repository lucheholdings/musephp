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
interface PasswordGrantTokenProviderInterface extends TokenProviderInterface
{
	/**
	 * getTokenWithPasswordGrant 
	 * 
	 * @access public
	 * @return void
	 */
	function getTokenWithPasswordGrant($username, $password, array $scopes = array(), $configs = array());
}
