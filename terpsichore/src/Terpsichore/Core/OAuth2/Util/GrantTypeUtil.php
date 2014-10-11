<?php
namespace Terpsichore\Core\OAuth2\Util;

use Terpsichore\Core\OAuth2\GrantTypes;
/**
 * GrantTypeUtil 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class GrantTypeUtil
{
	/**
	 * guess 
	 *   configs requests
	 *    - client_id
	 *    - client_secret
	 *    - code
	 *    - username
	 *    - password
	 * @param array $configs 
	 * @access public
	 * @return void
	 */
	public function guess(array $configs = array())
	{
		$configKeys = array_keys($configs);
		if($this->checkAuthorizationCodeParameters($configKeys, $configs)) {
			return GrantTypes::AUTHORIZATION_CODE;		
		} else if($this->checkPasswordParameters($configKeys, $configs)) {
			return GrantTypes::PASSWORD;
		} else if($this->checkClientCredentialsParameters($configKeys, $configs)) {
			return GrantTypes::CLIENT_CREDENTIALS;
		}

		return null;
	}

	/**
	 * checkAuthorizationCodeParameters 
	 * 
	 * @param mixed $configKeys 
	 * @param mixed $config 
	 * @access public
	 * @return void
	 */
	public function checkAuthorizationCodeParameters($configKeys, $config = array()) 
	{
		$diff = array_diff(
			array('client_id', 'client_secret', 'code'),
			$configKeys
		); 

		return empty($diff);
	}

	/**
	 * checkPasswordParameters 
	 * 
	 * @param mixed $configKeys 
	 * @param mixed $configs 
	 * @access public
	 * @return void
	 */
	public function checkPasswordParameters($configKeys, $configs = array()) 
	{
		$diff = array_diff(
			array('client_id', 'client_secret', 'username', 'password'),
			$configKeys
		); 
		return empty($diff);
	}

	/**
	 * checkClientCredentialsParameters 
	 * 
	 * @param mixed $configKeys 
	 * @param mixed $configs 
	 * @access public
	 * @return void
	 */
	public function checkClientCredentialsParameters($configKeys, $configs = array())
	{
		$diff = array_diff(
			array('client_id', 'client_secret'),
			$configKeys
		); 
		return empty($diff);
	}
}

