<?php
namespace Erato\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler;

// Symfony DI Components
use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
	Symfony\Component\DependencyInjection\Definition,
	Symfony\Component\DependencyInjection\Reference;

class NormalizerCompilerPass implements CompilerPassInterface 
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
		if($container->hasDefinition('erato_framework.normalizer.strategy_collection')) {
			$collection = $container->getDefinition('erato_framework.normalizer.strategy_collection');

			foreach($container->findTaggedServiceIds('erato_framework.normalizer.strategy') as $id => $tags) {
				foreach($tags as $params) {

					if(isset($params['priority'])) {
						$collection->addMethodCall(
							'add',
							array(new Reference($id), $params['priority'])
						);
					} else {
						$collection->addMethodCall(
							'add',
							array(new Reference($id))
						);
					}
				}
			}
		}
	}
}

