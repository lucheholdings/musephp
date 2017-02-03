<?php
namespace Clio\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler;

// Symfony DI Components
use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
	Symfony\Component\DependencyInjection\Definition,
	Symfony\Component\DependencyInjection\Reference;

/**
 * KvsCompilerPass
 * 
 * @uses CompilerPassInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class KvsCompilerPass implements CompilerPassInterface
{
	public function process(ContainerBuilder $container)
	{
		$this->registerFactories($container);
		$this->registerServices($container);
	}

	protected function registerFactories(ContainerBuilder $container)
	{
		// register kvss
		$registry = $container->findDefinition('clio_framework.kvs_factory');
		foreach($container->findTaggedServiceIds('clio_framework.kvs_factory') as $id => $tags) {
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
		// register kvss
		$registry = $container->findDefinition('clio_framework.kvs_registry');
		foreach($container->findTaggedServiceIds('clio_framework.kvs') as $id => $tags) {
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

