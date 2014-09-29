<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ClientBundle\DependencyInjection\Security\UserProvider;

use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\UserProvider\UserProviderFactoryInterface;

use Symfony\Component\Config\Definition\Builder\NodeDefinition;

use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * OAuth2UserProviderFactory 
 *    OAUth2UserProviderFactory create User Provider for OAuth2 Client Security.
 *    If Provider is gievn, then grab UserInfo
 *    Otherwise use DummyUser for Authentication.
 * @uses UserProviderFactoryInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class OAuth2UserProviderFactory implements UserProviderFactoryInterface 
{
	public function create(ContainerBuilder $container, $id, $config)
	{
		$arguments = array();
		if($config['provider']) {
			// Proxy UserProvider
			$abstractProviderId = 'clio_oauth2_client.user_provider.proxy';
		} else {
			// Use OAuth2DummyUserProvider 
			$abstractProviderId = 'clio_oauth2_client.user_provider.dummy';

		}

		// 
		$definition = $container
			->setDefinition($id, new DefinitionDecorator($abstractProviderId))
		;
		if($config['provider']) {
			$definition->replaceArgument(0, new Reference($config['provider']));
		}
	}

	/**
	 * getKey 
	 * 
	 * @access public
	 * @return void
	 */
	public function getKey()
	{
		return 'oauth2';
	}

	/**
	 * addConfiguration 
	 * 
	 * @param NodeDefinition $node 
	 * @access public
	 * @return void
	 */
	public function addConfiguration(NodeDefinition $node)
	{
		$node
			->children()
				->scalarNode('provider')->end()
			->end()
		;
	}
}

