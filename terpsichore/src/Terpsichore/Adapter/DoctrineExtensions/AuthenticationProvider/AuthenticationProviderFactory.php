<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Adapter\DoctrineExtensions\AuthenticationProvider;

class AuthenticationProviderFactory extends ProxyFactory
{
	public function createFromAuthenticationInfo(AuthenticationProviderInfo $info)
	{
		// Convert AuthenticationProviderInfo to configuration array
		$params = $info->convertToArray();

		return $this->getFactory()->create($params);
	}
}

