<?php
namespace Terpsichore\Server\Auth\OAuth\User\Provider;

/**
 * UserinfoProvider
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface UserinfoProvider
{
	/**
	 * getUserinfo 
	 * 
	 * @param mixed $token 
	 * @param mixed $ttl 
	 * @access public
	 * @return void
	 */
	function getUserinfo($token);

	/**
	 * getUserId 
	 * 
	 * @access public
	 * @return void
	 */
	function getUserId($token);
}

