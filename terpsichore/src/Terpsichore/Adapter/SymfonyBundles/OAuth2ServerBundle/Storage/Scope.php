<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage;

use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\Strategy\ScopeProviderStrategy;
use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\Strategy\ClientProviderStrategy;

use OAuth2\Storage as OAuth2Storage;
use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Util\StorageUtil;
use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Util\ScopeUtil;

/**
 * Scope 
 * 
 * @uses Storage
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Scope implements OAuth2Storage\ScopeInterface, StorageInterface
{
	/**
	 * scopeProvider 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $scopeProvider;

	/**
	 * clientProvider 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $clientProvider;

	/**
	 * util 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $util;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(ScopeProviderStrategy $scopeProvider, ClientProviderStrategy $clientProvider, ScopeUtil $util, array $options = array())
	{
		$this->scopeProvider = $scopeProvider;
		$this->clientProvider = $clientProvider;
		$this->util = $util;
		$this->options = $options;
	}

	public function getScopeProvider()
	{
		return $this->scopeProvider;
	}

	public function getClientProvider()
	{
		return $this->clientProvider;
	}

    /**
     * scopeExists 
     * 
     * @param mixed $scope 
     * @param mixed $client_id 
     * @access public
     * @return void
     */
    public function scopeExists($scope, $clientId = null)
    {
        $scope = $this->getScopeUtil()->toArray($scope);
		$supportedScopes = array();

		if ($clientId) {
			$client = $this->getClientProvider()->getClient($clientId);
			$scopes = $client->getSupportedScopes();
		} else {
			$scopes = $this->getScopeProvider()->getSupportedScopes();
		}

		// Merge the system and client supported scopes
        return (count(array_diff($scope, $scopes)) == 0);
    }

    /**
     * getDefaultScope 
     *   
     * @param mixed $client_id 
     * @access public
     * @return void
     */
    public function getDefaultScope($clientId = null)
    {
		var_dump($clientId);exit;
		// 
        if ($clientId) {
			$client = $this->getClientProvider()->getClient($clientId);
			$scopes = $client->getDefaultScopes();
		} else {
			// DefaultScopes
			$scopes = $this->getScopeProvider()->getDefaultScopes();
		}

        return $this->getScopeUtil()->fromArray($scopes);
    }
    
    public function getScopeUtil()
    {
        return $this->util;
    }
    
    public function setScopeUtil($util)
    {
        $this->util = $util;
        return $this;
    }
}
