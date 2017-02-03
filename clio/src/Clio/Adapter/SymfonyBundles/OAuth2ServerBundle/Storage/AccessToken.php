<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage;

use OAuth2\Storage;

use Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Util\StorageUtil;
/**
 * AccessToken 
 * 
 * @uses Storage
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AccessToken extends StrategicTokenStorage implements Storage\AccessTokenInterface
{
	/**
	 * getAccessTokenManager 
	 * 
	 * @access public
	 * @return void
	 */
	public function getAccessTokenManager()
	{
		return $this->getStrategy();
	}

	/**
	 * getAccessToken 
	 * 
	 * @param mixed $accessToken 
	 * @access public
	 * @return void
	 */
	public function getAccessToken($accessToken)
	{
		try {
			$token = $this->getStrategy()->findOneByToken($accessToken);
		} catch (NoResultException $ex) {
			$token = null;
		}

		return $token ? $this->getStorageUtil()->convertToken($token) : null;
	}


	/**
	 * setAccessToken 
	 * 
	 * @param mixed $accessToken 
	 * @param mixed $clientId 
	 * @param mixed $userId 
	 * @param mixed $expires 
	 * @param mixed $scope 
	 * @access public
	 * @return void
	 */
	public function setAccessToken($accessToken, $clientId, $userId, $expires, $scope = null) 
	{
		$expires = new \DateTime('@'.$expires);
		
		$token = null;
		try {
			$token = $this->getStrategy()->findOneByToken($accessToken);
		} catch (NoResultException $ex) {
			$token = null;
		}

		if(!$token) {
			$token = $this->getStrategy()->createToken();
		}

		// Update Token Status
		$token->setToken($accessToken);
		$token->setClientId($clientId);
		$token->setUserId($userId);
		$token->setExpiresAt($expires);
		$token->setScopes($this->getStorageUtil()->getScopeUtil()->toArray($scope));

		// TokenManagre::save
		$this->getStrategy()->save($token);
	}
}

