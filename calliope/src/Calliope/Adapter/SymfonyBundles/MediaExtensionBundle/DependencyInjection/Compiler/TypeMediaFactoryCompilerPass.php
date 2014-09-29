<?php
namespace Calliope\Adapter\SymfonyBundles\MediaExtensionBundle\DependencyInjection\Compiler;

// Symfony DI Components
use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
	Symfony\Component\DependencyInjection\Definition,
	Symfony\Component\DependencyInjection\Reference;

/**
 * TypeMediaFactoryCompilerPass 
 * 
 * @uses CompilerPassInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TypeMediaFactoryCompilerPass implements CompilerPassInterface 
{
	public function process(ContainerBuilder $container)
	{
		if($container->hasDefinition('calliope_media_extension.type_media_factory')) {
			$registry = $container->getDefinition('calliope_media_extension.type_media_factory');

			foreach($container->findTaggedServiceIds('calliope_media_extension.type_media_factory') as $id => $tags) {
				foreach($tags as $tagAttrs) {
					$registry->addMethodCall(
						'setMediaFactory',
						array($tagAttrs['for'], new Reference($id))
					);
				}
			}
		}
	}
}
