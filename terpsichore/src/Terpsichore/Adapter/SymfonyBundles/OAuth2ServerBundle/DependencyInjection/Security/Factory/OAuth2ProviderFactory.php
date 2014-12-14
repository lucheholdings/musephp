<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\DependencyInjection\Security\Factory;

use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\SecurityFactoryInterface;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;
/**
 * OAuth2ProviderFactory 
 *   SecurtiyFactory to craete "oatuh2" security type which is for OAuth2 ResourceProvider. 
 * 
 * @uses SecurityFactoryInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class OAuth2ProviderFactory implements SecurityFactoryInterface 
{
    /**
     * {@inheritdoc}
     */
    public function create(ContainerBuilder $container, $id, $config, $userProvider, $defaultEntryPoint)
    {
        $providerId = 'security.authentication.provider.terpsichore_oauth2_server.'.$id;
		
		// UserProvider 
		$container->setAlias('terpsichore_oauth2_server.security.user_provider.' . $id, $userProvider);

		$scopes = $config['scopes'];
		$scopeMap = new DefinitionDecorator('terpsichore_oauth2_server.security.scope_role_map._default');
		$container
			->setDefinition('terpsichore_oauth2_server.security.scope_role_map.' . $id, $scopeMap)
			->replaceArgument(0, $scopes)
		;
		
		// AuthenticationProvider
        $container
            ->setDefinition($providerId, new DefinitionDecorator('terpsichore_oauth2_server.security.authentication_provider._default'))
            ->replaceArgument(0, new Reference('terpsichore_oauth2_server.security.user_provider.' . $id))
			->replaceArgument(1, new Reference('terpsichore_oauth2_server.security.scope_role_map.' . $id))
        ;

        $listenerId = 'security.authentication.listener.terpsichore_oauth2_server.'.$id;
		// Listner
		$listenerDefinition = new DefinitionDecorator('terpsichore_oauth2_server.security.authentication_listener._default');
        $container
			->setDefinition($listenerId, $listenerDefinition)
			->replaceArgument(1, new Reference($providerId))
			->replaceArgument(2, new Reference('terpsichore_oauth2_server.security.token_resolver'))
		;

        return array($providerId, $listenerId, 'terpsichore_oauth2_server.security.entry_point');
    }

    /**
     * {@inheritdoc}
     */
    public function getPosition()
    {
        return 'pre_auth';
    }

    /**
     * {@inheritdoc}
     */
    public function getKey()
    {
        return 'oauth2-provider';
    }

    /**
     * {@inheritdoc}
     */
    public function addConfiguration(NodeDefinition $node)
    {
		$node
			->children()
				->scalarNode('provider')->end()
				->arrayNode('scopes')
					->prototype('scalar')->end()
				->end()
			->end()
		;
    }
}

