<?php
namespace Terpsichore\Server\Auth\OAuth\User\Provider;

use Terpsichore\Server\Auth\OAuth\Token\ClientTokenInterface;

/**
 * UserProviderInterface 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface UserProviderInterface
{
	/**
	 * findUserByAccessToken 
	 * 
	 * @param ClientTokenInterface $token 
	 * @access public
	 * @return void
	 */
	function findUserByAccessToken(ClientTokenInterface $token);
}

