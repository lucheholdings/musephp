<?php
namespace Clio\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler;

// Symfony DI Components
use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
	Symfony\Component\DependencyInjection\Definition,
	Symfony\Component\DependencyInjection\Reference;

class FieldAccessorLayerFactoryCompilerPass implements CompilerPassInterface 
{
	/**
	 * process 
	 * 
	 * @param ContainerBuilder $container 
	 * @access public
	 * @return void
	 */
	public function process(ContainerBuilder $container)
	{
		if($container->hasDefinition('clio_framework.field_accessor_builder_factory.layer')) {
			// Get the Factory of LayeredBuilder
			$builderFactory = $container->getDefinition('clio_framework.field_accessor_builder_factory.layer');

			foreach($container->findTaggedServiceIds('clio_framework.layer_field_accessor_factory') as $id => $tags) {
				foreach($tags as $tag) {
					
					// PRIORITY
					$priority = isset($tag['priority']) ? $tag['priority'] : 0;

					// Add Layer Factory
					$builderFactory->addMethodCall(
						'addDefaultLayerFactory',
						array(new Reference($id), $priority)
					);
				}
			}
		}
	}
}

