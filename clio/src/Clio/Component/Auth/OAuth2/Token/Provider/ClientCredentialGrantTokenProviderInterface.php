<?php
namespace Clio\Component\Auth\OAuth2\Token\Provider;

/**
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
interface ClientCredentialGrantTokenProviderInterface extends TokenProviderInterface
{
	/**
	 * getTokenWithClientCredentialsGrant 
	 * 
	 * @access public
	 * @return void
	 */
	function getTokenWithClientCredentialsGrant(array $scopes = array(), $configs = array());
}

