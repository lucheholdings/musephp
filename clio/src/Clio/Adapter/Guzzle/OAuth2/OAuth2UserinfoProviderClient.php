<?php
namespace Clio\Adapter\Guzzle\OAuth2;
use Guzzle\Http\Client;
use Clio\Component\Auth\OAuth2\User\Provider\UserinfoProvider;

/**
 * OAuth2UserinfoProviderClient 
 * 
 * 
 *  configurations: 
 * 		- userinfo <array>
 			- path : <string>User Info API URI
 *			- mappings : <array>Mapping conversion rule from key to value for response
 * 
 * @uses Client
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class OAuth2UserinfoProviderClient extends Client
  implements
    UserinfoProvider
{
	/**
	 * getUserinfo 
	 * 
	 * @param mixed $token 
	 * @param mixed $ttl 
	 * @access public
	 * @return void
	 */
	public function getUserinfo($token)
	{
		$req = $this->get($this->getUserinfoPath(), array('Authorization' => 'Bearer ' . $token));
		
		$res = $req->send();

		return json_decode((string)$res->getBody(), true);
	}

	/**
	 * getUserId 
	 * 
	 * @access public
	 * @return void
	 */
	public function getUserId($token)
	{
		$userinfo = $this->getUserinfo($token);

		return $userinfo['id'];
	}

	public function getUserinfoPath()
	{
		return $this->getConfig('userinfo_path');
	}

	public function setUserinfoPath($path)
	{
		$this->getConfig()->set('userinfo_path', $path);
	}
}

