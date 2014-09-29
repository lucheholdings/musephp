<?php
namespace Calliope\Adapter\SymfonyBundles\MediaExtensionBundle\DependencyInjection\Compiler;

// Symfony DI Components
use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
	Symfony\Component\DependencyInjection\Definition,
	Symfony\Component\DependencyInjection\Reference;

/**
 * MediaCompilerPass 
 * 
 * @uses CompilerPassInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MediaCompilerPass implements CompilerPassInterface 
{
	public function process(ContainerBuilder $container)
	{
		if($container->hasDefinition('calliope_media_extension.media_registry')) {
			$registry = $container->getDefinition('calliope_media_extension.media_registry');

			foreach($container->findTaggedServiceIds('calliope_media_extension.media') as $id => $tags) {
				foreach($tags as $tagAttrs) {
					
					$registry->addMethodCall(
						'addMedia',
						array(new Reference($id))
					);
				}
			}
		}
	}
}

