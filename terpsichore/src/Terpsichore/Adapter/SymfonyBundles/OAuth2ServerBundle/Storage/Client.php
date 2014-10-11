<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage;

use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\Strategy\ClientProviderStrategy;
use OAuth2\Storage as OAuth2Storage;
use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Util\StorageUtil;

/**
 * Client 
 * 
 * @uses StrategicStorage
 * @uses Storage
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Client extends StrategicStorage implements OAuth2Storage\ClientInterface
{
	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(ClientProviderStrategy $strategy, StorageUtil $storageUtil = null)
	{
		parent::__construct($strategy, $storageUtil);
	}

	public function getClientProvider()
	{
		return $this->getStrategy();
	}

	public function getClient($clientId)
	{
		$client = null;
		try {
			$client = $this->getClientProvider()->getClient($clientId);
		} catch(NoResultException $ex) {
			$client = null;
		}
		return $client;
	}

    /**
     * getClientDetails 
     * 
     * @param mixed $clientId 
     * @access public
     * @return void
     */
    public function getClientDetails($clientId)
    {
		$client = $this->getClient($clientId);
		if($client) {
			return $this->getStorageUtil()->convertClient($client);
		}
		return null;
    }

	public function getClientScope($clientId)
	{
		if (!$client = $this->getClient($clientId)) {
			return false;
		}

		$scope = $this->getStorageUtil()->getScopeUtil()->fromArray(
				$client->getSupportedScopes()
			);

		return $scope;
	}

    public function checkRestrictedGrantType($clientId, $grant_type)
    {
        $client = $this->getClientDetails($clientId);
        if (isset($details['grant_types'])) {
            return in_array($grant_type, (array) $details['grant_types']);
        }

        // if grant_types are not defined, then none are restricted
        return true;
    }
}

