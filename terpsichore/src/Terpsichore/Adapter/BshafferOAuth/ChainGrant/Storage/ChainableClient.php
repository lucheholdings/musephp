<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Adapter\BshafferOAuth\ChainGrant\Storage;

/**
 * ChainableClient
 * 
 * @package ${ PACKAGE }
 * @subpackage 
 * @author ${ AUTHOR }
 */
interface ChainableClient
{
	/**
	 * createAuthenticateToken 
	 * 
	 * @param $name Name of the provider to chain
	 * @access public
	 * @return void
	 */
	function createAuthenticateToken($name);
}

