<?php
namespace Clio\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler;

// Symfony DI Components
use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
	Symfony\Component\DependencyInjection\Definition,
	Symfony\Component\DependencyInjection\Reference;

class PropertyFieldAccessorFactoryCompilerPass implements CompilerPassInterface 
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
		// Get the Factory of LayeredBuilder
		if($container->hasDefinition('clio_framework.field_accessor_factory.property_field_collection')) {
			$factory = $container->findDefinition('clio_framework.field_accessor_factory.property_field_collection');

			foreach($container->findTaggedServiceIds('clio_framework.property_field_accessor_factory') as $id => $tags) {
				foreach($tags as $tag) {
					if(!isset($tag['type'])) {
						throw new \Clio\Component\Exception\InvalidArgumentException(sprintf('Tag "clio_framework.property_field_accessor_factory" for service "%s" required attribute "type".', $id));
					}
					// Add Layer Factory
					$factory->addMethodCall(
						'setPropertyFieldAccessorFactory',
						array($tag['type'], new Reference($id))
					);
				}
			}
		}
	}
}

