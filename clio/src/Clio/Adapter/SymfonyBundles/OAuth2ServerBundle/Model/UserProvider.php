<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Model;

use Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\Strategy\ChainUserProviderStrategy; 
/**
 * UserProvider 
 * 
 * @uses UserProviderInterface
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class UserProvider implements ChainUserProviderStrategy
{
	/**
	 * {@inheritdoc}
	 */
	public function loadUserById($id)
	{
		return null;
	}

	public function loadUserByProviderId($providerName, $id)
	{
		return null;
	}
}

