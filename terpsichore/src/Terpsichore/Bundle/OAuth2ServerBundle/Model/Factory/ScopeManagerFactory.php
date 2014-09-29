<?php
namespace Terpsichore\Bundle\OAuth2ServerBundle\Model\Factory;

use Terpsichore\Bundle\OAuth2ServerBundle\Storage\Strategy\Factory\ScopeProviderFactory;

/**
 * ScopeProviderFactory 
 * 
 * @uses ScopeProviderFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ScopeProviderFactory implements ScopeProviderFactory
{
	public function createScopeManager($connectTo, array $options = array())
	{
		return new ScopeManager($options); 
	}
}
