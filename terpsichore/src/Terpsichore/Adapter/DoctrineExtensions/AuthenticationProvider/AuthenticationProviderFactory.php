<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Adapter\DoctrineExtensions\AuthenticationProvider;

use Terpsichore\Adapter\DoctrineExceptions\AuthenticationProvider\Model\AuthenticationProvider;

/**
 * AuthenticationProviderFactory 
 * 
 * @uses ProxyFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AuthenticationProviderFactory extends ProxyFactory
{
	/**
	 * createAuthenticationProvider 
	 *    Create AuthenticationProvider from Info 
	 * @param AuthenticationProvider $info 
	 * @access public
	 * @return void
	 */
	public function createAuthenticationProvider(ProviderInfo $info)
	{
		// Convert AuthenticationProviderInfo to configuration array
		return $this->getFactory()->createAuthenticationProvider($info->getName(), $info->getAttributes());
	}
}

