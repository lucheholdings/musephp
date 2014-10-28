<?php
namespace Clio\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler;

// Symfony DI Components
use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
	Symfony\Component\DependencyInjection\Definition,
	Symfony\Component\DependencyInjection\Reference;

class AccessorCompilerPass implements CompilerPassInterface 
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
		$this->processClassFieldAccessorFactory($container);
		$this->processClassAccessorFactory($container);
	}

	protected function processClassAccessorFactory(ContainerBuilder $container)
	{
		if($container->hasDefinition('clio_framework.accessor.accessor_factory.collection')) {
			$collection = $container->getDefinition('clio_framework.accessor.accessor_factory.collection');

			foreach($container->findTaggedServiceIds('clio_framework.accessor.accessor_factory') as $id => $tags) {
				foreach($tags as $params) {
					$priority = isset($params['priority']) ? $params['priority'] : 0;

					$collection->addMethodCall(
						'add',
						array(new Reference($id), $priority)
					);
				}
			}
		}
	}

	protected function processClassFieldAccessorFactory(ContainerBuilder $container)
	{
		if($container->hasDefinition('clio_framework.accessor.accessor_factory.basic')) {
			$collection = $container->getDefinition('clio_framework.accessor.accessor_factory.basic');

			foreach($container->findTaggedServiceIds('clio_framework.accessor.field_accessor_factory') as $id => $tags) {
				foreach($tags as $params) {
					$priority = isset($params['priority']) ? $params['priority'] : 0;

					$collection->addMethodCall(
						'add',
						array(new Reference($id), $priority)
					);
				}
			}
		}
	}
}

