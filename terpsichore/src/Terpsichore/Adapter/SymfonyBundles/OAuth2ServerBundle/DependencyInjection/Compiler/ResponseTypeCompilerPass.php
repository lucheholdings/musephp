<?php

namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;

/**
 * ResponseTypeCompilerPass 
 *    Call OAuth2::addResponseType for tag "terpsichore_oauth2_server.response_type"
 * 
 * @uses CompilerPassInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ResponseTypeCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if($container->hasDefinition('terpsichore_oauth2_server.server')) {
			$serverDefinition = $container->getDefinition('terpsichore_oauth2_server.server');
			
			// Set ResponseTypes for OAuth2Server
			foreach($container->findTaggedServiceIds('terpsichore_oauth2_server.response_type') as $id => $tags) {
				foreach($tags as $tagParams) {
					$serverDefinition->addMethodCall('addResponseType', array(new Reference($id), isset($tagParams['for']) ? $tagParams['for'] : null));
				}
			}
		}
    }
}
