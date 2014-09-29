<?php
namespace Terpsichore\Bundle\OAuth2ServerBundle\Storage;

use OAuth2\Storage;
use Terpsichore\Bundle\OAuth2ServerBundle\Util\StorageUtil;

/**
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class RefreshToken extends StrategicTokenStorage implements Storage\RefreshTokenInterface
{

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(Strategy\TokenManagerStrategy $strategy, StorageUtil $storageUtil = null)
	{
		parent::__construct($strategy, $storageUtil);
	}

	/**
	 * getRefreshTokenManager 
	 * 
	 * @access public
	 * @return void
	 */
	public function getRefreshTokenManager()
	{
		return $this->getStrategy();
	}

	public function getRefreshToken($refreshToken) 
	{
		try {
			$token = $this->getRefreshTokenManager()->findOneByToken($refreshToken);
		} catch (NoResultException $ex) {
			$token = null;
		}

		return $token ? $this->getStorageUtil()->convertToken($token) : null;
	}

    public function setRefreshToken($refreshToken, $clientId, $userId, $expires, $scope = null)
    {
        // convert expires to datestring
        $expires = date('Y-m-d H:i:s', $expires);
		
		$token = $this->getRefreshTokenManager()->create();
		$token->setToken($refreshToken);
		$token->setClientId($clientId);
		$token->setUserId($userId);
		$token->setExpiresAt(new \DateTime($expires));
		$token->setScopes($this->getStorageUtil()->getScopeUtil()->toArray($scope));

		$this->getRefreshTokenManager()->save($token);
    }

    public function unsetRefreshToken($refreshToken)
    {
		try {
			$token = $this->getRefreshTokenManager()->findOneByToken($refreshToken);
			if($token) {
				$this->getRefreshTokenManager()->remote($token);
			}
		} catch(NoResultException $ex) {
			//
		}
    }
}

