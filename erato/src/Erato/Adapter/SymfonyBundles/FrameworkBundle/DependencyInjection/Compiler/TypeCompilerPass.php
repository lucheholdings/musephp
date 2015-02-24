<?php
namespace Erato\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler;

// Symfony DI Components
use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
	Symfony\Component\DependencyInjection\Definition,
	Symfony\Component\DependencyInjection\Reference;

class TypeCompilerPass implements CompilerPassInterface 
{
	const DEFAULT_PRIOIRTY = 100;
	/**
	 * process 
	 * 
	 * @param ContainerBuilder $container 
	 * @access public
	 * @return void
	 */
	public function process(ContainerBuilder $container)
	{
		$this->processStrategy($container);
	}

	protected function processStrategy(ContainerBuilder $container)
	{
		if($container->hasDefinition('erato_framework.type_factory.decorate')) {
			$collection = $container->getDefinition('erato_framework.type_factory.decorate');

			foreach($container->findTaggedServiceIds('erato_framework.type_factory.decorate') as $id => $tags) {
				foreach($tags as $params) {
					$collection->addMethodCall(
						'addFactory',
						array(new Reference($id))
					);
				}
			}
		}
	}
}

