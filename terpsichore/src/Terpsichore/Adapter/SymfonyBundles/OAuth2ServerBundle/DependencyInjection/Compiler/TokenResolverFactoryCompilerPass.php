<?php

namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;

class TokenResolverFactoryCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if($container->hasDefinition('terpsichore_oauth2_server.security.token_resolver_factory')) {
			$serverDefinition = $container->getDefinition('terpsichore_oauth2_server.security.token_resolver_factory');
			
			foreach($container->findTaggedServiceIds('terpsichore_oauth2_server.token_resolver_factory') as $id => $tags) {
				foreach($tags as $tagParams) {
					if(isset($tagParams['for'])) {
						$serverDefinition->addMethodCall('set', array($tagParams['for'], new Reference($id)));
					}
				}
			}
		}
    }
}
