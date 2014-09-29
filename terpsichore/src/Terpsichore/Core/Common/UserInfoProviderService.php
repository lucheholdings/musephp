<?php
namespace Terpsichore\Core\Common;

/**
 * UserInfoProviderService 
 *    Service to provide specified userinfo 
 * @uses Service
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface UserInfoProviderService extends Service
{
	/**
	 * getUserInfo 
	 * 
	 * @param mixed $id user id/username 
	 * @access public
	 * @return void
	 */
	function getUserInfo($id);
}

