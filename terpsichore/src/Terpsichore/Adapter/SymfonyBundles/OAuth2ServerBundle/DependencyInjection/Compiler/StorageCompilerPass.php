<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;

/**
 * StorageCompilerPass 
 * 
 * @uses CompilerPassInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class StorageCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
		if($container->hasDefinition('terpsichore_oauth2_server.server')) {
			$server = $container->findDefinition('terpsichore_oauth2_server.server');
        	$services = $container->findTaggedServiceIds('terpsichore_oauth2_server.storage');
			
			$storages = array();
			foreach($services as $id => $tags) {
				foreach($tags as $tagParams) {
					$server->addMethodCall('addStorage', array(new Reference($id), isset($tagParams['for']) ? $tagParams['for'] : null));
				}
			}
		}
    }
}
