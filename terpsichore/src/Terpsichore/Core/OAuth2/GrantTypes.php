<?php
namespace Terpsichore\Core\OAuth2;

/**
 * GrantTypes 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class GrantTypes
{
	/** 
	 * @const
	 */
	const AUTHORIZATION_CODE = 'authorization_code';

	/** 
	 * @const
	 */
	const PASSWORD           = 'password';

	/** 
	 * @const
	 */
	const CLIENT_CREDENTIALS = 'client_credentials';

	/**
	 * @const
	 */
	const CHAIN              = 'chain';
}

