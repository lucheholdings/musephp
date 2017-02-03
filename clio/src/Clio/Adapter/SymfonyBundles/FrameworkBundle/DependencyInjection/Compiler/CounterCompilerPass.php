<?php
namespace Clio\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler;

// Symfony DI Components
use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
	Symfony\Component\DependencyInjection\Definition,
	Symfony\Component\DependencyInjection\Reference;

/**
 * CounterCompilerPass
 * 
 * @uses CompilerPassInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class CounterCompilerPass implements CompilerPassInterface
{
	public function process(ContainerBuilder $container)
	{
		$this->registerFactories($container);
		$this->registerServices($container);
	}

	protected function registerFactories(ContainerBuilder $container)
	{
		// register counters
		$registry = $container->findDefinition('clio_framework.counter_factory');
		foreach($container->findTaggedServiceIds('clio_framework.counter_factory') as $id => $tags) {
			foreach($tags as $tagAttrs) {
				if(isset($tagAttrs)) {
					$registry->addMethodCall(
						'set', array(
							$tagAttrs['for'],
							new Reference($id)
						)
					);
				} 
			}
		}
	}

	protected function registerServices(ContainerBuilder $container)
	{
		// register counters
		$registry = $container->findDefinition('clio_framework.counter_registry');
		foreach($container->findTaggedServiceIds('clio_framework.counter') as $id => $tags) {
			foreach($tags as $tagAttrs) {
				if(isset($tagAttrs)) {
					//  
					$registry->addMethodCall(
						'setAlias', array(
							$tagAttrs['for'],
							$id
						)
					);
				} 
			}
		}
	}
}

