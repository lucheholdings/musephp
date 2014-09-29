<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Core\Auth\Token;

use Terpsichore\Core\Auth\Token;
use Terpsichore\Core\Auth\Provider;

/**
 * AuthenticateToken
 * 
 * @package ${ PACKAGE }
 * @subpackage 
 * @author ${ AUTHOR }
 */
interface AuthenticateToken extends Token 
{
	/**
	 * setProvider 
	 * 
	 * @param Provider $provider 
	 * @access public
	 * @return void
	 */
	function setProvider(Provider $provider);

	/**
	 * isAuthenticated 
	 * 
	 * @access public
	 * @return void
	 */
	function isAuthenticated();

	/**
	 * isUserCredentials 
	 * 
	 * @access public
	 * @return void
	 */
	function isUserCredentials();

	/**
	 * getUser 
	 * 
	 * @access public
	 * @return User
	 */
	function getUser();
}

