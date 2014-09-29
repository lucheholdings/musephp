<?php
namespace Terpsichore\Bundle\OAuth2ServerBundle\Storage;

use Terpsichore\Bundle\OAuth2ServerBundle\Storage\Strategy\ClientProviderStrategy;
use OAuth2\Storage as OAuth2Storage;
use Terpsichore\Bundle\OAuth2ServerBundle\Util\StorageUtil;

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

    /**
     * getClientDetails 
     * 
     * @param mixed $clientId 
     * @access public
     * @return void
     */
    public function getClientDetails($clientId)
    {
		try {
			$client = $this->getClientProvider()->findOneByClientId($clientId);

			if($client) {
				// Convert Client object to acceptable array
	        	return $this->getStorageUtil()->convertClient($client);
			} 
		} catch(NoResultException $ex) {
			return null; 
		}

		return null;
    }

	public function getClientScope($clientId)
	{
		if (!$clientDetails = $this->getClientDetails($clientId)) {
			return false;
		}

		if (isset($clientDetails['scope'])) {
			return $clientDetails['scope'];
		}

		return null;
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

