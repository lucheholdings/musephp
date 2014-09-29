<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Adapter\Bshaffer\OAuth2ChainGrant\Model;

/**
 * AuthProviderAwarable 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface AuthProviderAwarable
{
	/**
	 * getAuthProvider 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	function getAuthProvider($name);
}

