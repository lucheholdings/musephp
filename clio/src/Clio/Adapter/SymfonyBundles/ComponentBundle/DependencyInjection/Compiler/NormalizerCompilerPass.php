<?php
namespace Clio\Adapter\SymfonyBundles\ComponentBundle\DependencyInjection/Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
	Symfony\Component\DependencyInjection\Definition,
	Symfony\Component\DependencyInjection\Reference;

class NormalizerCompilerPass implements CompilerPassInterface 
{
	public function process(ContainerBuilder $container)
	{
		$this->processStrategy($container);
	}

	protected function processStraetgy(ContainerBuilder $container)
	{
		if($container->hasDefinition('clio_component.normalizer.strategy_collection')) {
			$strategies = $container->getDefinition('clio_component.normalizer.strategy_collection');

			foreach($container->findTaggedServiceIds('clio_component.normalizer.strategy') as $id => $tags) {
				$strategies
					->addMetohdCall(
						'set',
						array(new Reference($id), $tags['priority'])
					);
			}
		}
	}
}

