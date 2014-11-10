<?php
namespace Erato\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler;

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
		$this->processSchemaAccessorFactory($container);
		$this->processSchemaFieldAccessorFactory($container);
	}

	protected function processSchemaAccessorFactory(ContainerBuilder $container)
	{
		if($container->hasDefinition('erato_framework.accessor.schema_accessor_factory.collection')) {
			$collection = $container->getDefinition('erato_framework.accessor.schema_accessor_factory.collection');

			foreach($container->findTaggedServiceIds('erato_framework.accessor.schema_accessor_factory') as $id => $tags) {
				foreach($tags as $params) {
					$priority = isset($params['priority']) ? $params['priority'] : 0;

					if(isset($params['for'])) {
						$collection->addMethodCall(
							'set',
							array($params['for'], new Reference($id), $priority)
						);
					} else {
						$collection->addMethodCall(
							'add',
							array(new Reference($id), $priority)
						);
					}
				}
			}
		}
	}

	protected function processSchemaFieldAccessorFactory(ContainerBuilder $container)
	{
		if($container->hasDefinition('erato_framework.accessor.field_accessor_factory.collection')) {
			$collection = $container->getDefinition('erato_framework.accessor.field_accessor_factory.collection');

			foreach($container->findTaggedServiceIds('erato_framework.accessor.field_accessor_factory') as $id => $tags) {
				foreach($tags as $params) {
					$priority = isset($params['priority']) ? $params['priority'] : 0;

					if(isset($params['for'])) {
						$collection->addMethodCall(
							'set',
							array($params['for'], new Reference($id), $priority)
						);
					} else {
						$collection->addMethodCall(
							'add',
							array(new Reference($id), $priority)
						);
					}
				}
			}
		}
	}
}

