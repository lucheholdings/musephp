<?php
namespace Terpsichore\Server\Auth\OAuth\Token\Provider;
use Terpsichore\Server\Auth\OAuth\Token\ClientTokenInterface;

/**
 * RefreshGrantTokenProviderInterface 
 * 
 * @uses TokenProviderInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface RefreshGrantTokenProviderInterface extends TokenProviderInterface
{
	/**
	 * getTokenWithPasswordGrant 
	 * 
	 * @access public
	 * @return void
	 */
	function refreshToken(ClientTokenInterface $token);
}
