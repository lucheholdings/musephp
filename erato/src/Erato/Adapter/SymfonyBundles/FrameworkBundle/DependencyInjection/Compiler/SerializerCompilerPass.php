<?php
namespace Erato\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler;

// Symfony DI Components
use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
	Symfony\Component\DependencyInjection\Definition,
	Symfony\Component\DependencyInjection\Reference;

/**
 * SerializerCompilerPass:w
 * 
 * @uses CompilerPassInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SerializerCompilerPass implements CompilerPassInterface
{
	public function process(ContainerBuilder $container)
	{
		if($container->hasDefinition('erato_framework.serializer.strategy_collection')) {
			$registry = $container->getDefinition('erato_framework.serializer.strategy_collection');
			foreach($container->findTaggedServiceIds('erato_framework.serializer.strategy') as $id => $tags) {
				foreach($tags as $tagAttrs) {
					if(isset($tagAttrs)) {
						//  
						$registry->addMethodCall(
							'add', array(
								new Reference($id),
								$tagAttrs['priority']
							)
						);
					} 
				}
			}
		}
	}
}

