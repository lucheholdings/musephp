<?php

namespace Terpsichore\Bundle\OAuth2ServerBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;

/**
 * GrantTypeCompilerPass 
 *    Call OAuth2::addGrantType for tag "terpsichore_oauth2_server.grant_type"
 * 
 * @uses CompilerPassInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class GrantTypeCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if($container->hasDefinition('terpsichore_oauth2_server.server')) {
			$serverDefinition = $container->getDefinition('terpsichore_oauth2_server.server');
			
			foreach($container->findTaggedServiceIds('terpsichore_oauth2_server.grant_type') as $id => $tags) {
				foreach($tags as $tagParams) {
					$serverDefinition->addMethodCall('addGrantType', array(new Reference($id), isset($tagParams['for']) ? $tagParams['for'] : null));
				}
			}
		}
    }
}
