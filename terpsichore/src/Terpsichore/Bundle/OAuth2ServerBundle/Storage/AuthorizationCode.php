<?php
namespace Terpsichore\Bundle\OAuth2ServerBundle\Storage;

use OAuth2\Storage;
use Terpsichore\Bundle\OAuth2ServerBundle\Util\StorageUtil;

/**
 * AuthorizationCode 
 * 
 * @uses Storage
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AuthorizationCode extends StrategicTokenStorage implements Storage\AuthorizationCodeInterface
{
	/**
	 * getAuthCodeManager 
	 * 
	 * @access public
	 * @return void
	 */
	public function getAuthCodeManager()
	{
		return $this->getStrategy();
	}

    /**
     * getAuthorizationCode 
     * 
     * @param mixed $code 
     * @access public
     * @return void
     */
    public function getAuthorizationCode($code)
    {
		try {
			$token = $this->getAuthCodeManager()->findOneByToken($code);
		} catch(NoResultException $ex) {
			$token = null;
		}

		return $token ? $this->getStorageUtil()->convertToken($token) : null;
    }

    /**
     * setAuthorizationCode 
     * 
     * @param mixed $code 
     * @param mixed $clientId 
     * @param mixed $userId 
     * @param mixed $redirect_uri 
     * @param mixed $expires 
     * @param mixed $scope 
     * @access public
     * @return void
     */
    public function setAuthorizationCode($code, $clientId, $userId, $redirect_uri, $expires, $scope = null)
    {
		$expires = new \DateTime('@'.$expires);
		
		$token = null;

		try {
			$token = $this->getAuthCodeManager()->findOneByToken($code);
		} catch (NoResultException $ex) {
			$token = null;
		}

		if(!$token) {
			$token = $this->getAuthCodeManager()->createToken();
		}

		$token->setToken($code);
		$token->setClientId($clientId);
		$token->setUserId($userId);
		$token->setExpiresAt($expires);
		$token->setScopes($this->getStorageUtil()->getScopeUtil()->toArray($scope));

		$this->getAuthCodeManager()->save($token);
    }

    /**
     * expireAuthorizationCode 
     * 
     * @param mixed $code 
     * @access public
     * @return void
     */
    public function expireAuthorizationCode($code)
    {
		try {
			$token = $this->getAuthCodeManager()->findOneByToken($code);
			
			if($token)
				$this->getAuthCodeManager()->delete($token);
		} catch(NoResultException $ex) {

		}
    }
}

