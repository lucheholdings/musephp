<?php
namespace Terpsichore\Bundle\OAuth2ServerBundle\Storage;

use OAuth2\Storage as OAuth2Storage;

/**
 * ClientCredentials 
 * 
 * @uses Client
 * @uses Storage
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ClientCredentials extends Client implements OAuth2Storage\ClientCredentialsInterface
{
    /**
     * checkClientCredentials 
     * 
     * @param mixed $clientId 
     * @param mixed $client_secret 
     * @access public
     * @return void
     */
    public function checkClientCredentials($clientId, $client_secret = null)
    {
		$client = $this->getClientProvider()->findOneByClientId($clientId);

        // make this extensible
		if($client) {
        	return $client->getClientSecret() == $client_secret;
		}

		return false;
    }

	/**
	 * isPublicClient 
	 * 
	 * @param mixed $clientId 
	 * @access public
	 * @return void
	 */
	public function isPublicClient($clientId)
	{
		$client = $this->getClientProvider()->findOneByClientId($clientId);

        // make this extensible
		if($client) {
			$secret = $client->getClientSecret();
        	return empty($secret);
		}

		return false;
	}
}

