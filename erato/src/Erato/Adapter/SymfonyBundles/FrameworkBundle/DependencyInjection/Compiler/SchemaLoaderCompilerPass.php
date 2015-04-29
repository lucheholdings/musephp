<?php
namespace Erato\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler;

// Symfony DI Components
use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
	Symfony\Component\DependencyInjection\Definition,
	Symfony\Component\DependencyInjection\Reference;

class SchemaLoaderCompilerPass implements CompilerPassInterface 
{
	public function process(ContainerBuilder $container)
	{
		$this->processSchemaLoader($container);
	}

	protected function processSchemaLoader($container)
	{
		if($container->hasDefinition('erato_framework.schema.loader')) {
			$loader = $container->getDefinition('erato_framework.schema.loader');

            $loaders = array();
			foreach($container->findTaggedServiceIds('erato_framework.schema.loader') as $id => $tags) {
				foreach($tags as $tag) {
                    $priority = isset($tag['priority']) ? $tag['priority'] : 0;
                    $loaders[$priority][] = $id;
				}
			}

            krsort($loaders);

            foreach($loaders as $priorityLoaders) {
                foreach($priorityLoaders as $id) {
                    $loader->addMethodCall('append', array(new Reference($id)));
                }
            }
		}
	}
}

