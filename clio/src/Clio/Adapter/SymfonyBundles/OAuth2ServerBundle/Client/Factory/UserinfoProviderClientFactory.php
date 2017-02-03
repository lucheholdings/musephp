<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Client\Factory;

use Doctrine\Common\Cache\Cache;
use Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Factory;
use Clio\Adapter\Guzzle\OAuth2\OAuth2UserinfoProviderClient;
use Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\User\CachedUserinfoProvider;
/**
 * UserinfoProviderClientFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class UserinfoProviderClientFactory 
{
	/**
	 * createUserinfoProvider 
	 * 
	 * @param mixed $baseurl 
	 * @param array $configs 
	 * @param Cache $cache 
	 * @access public
	 * @return void
	 */
	public function createUserinfoProvider($baseurl, array $configs = array(), Cache $cache = null)
	{
		//
		$provider = new OAuth2UserinfoProviderClient($baseurl, $configs);

		if($cache) {
			$provider = new CachedUserinfoProvider($provider, $cache);
		}

		return $provider;
	}
}

