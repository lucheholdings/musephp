<?php
namespace Erato\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler;

// Symfony DI Components
use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
	Symfony\Component\DependencyInjection\Definition,
	Symfony\Component\DependencyInjection\Reference;

/**
 * FeidlMapperCompilerPass
 * 
 * @uses CompilerPassInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FieldMapperCompilerPass implements CompilerPassInterface
{
	public function process(ContainerBuilder $container)
	{
		// register counters
		$registry = $container->findDefinition('erato_framework.schemifier_field_mapper_registry');
		if($registry) {
			foreach($container->findTaggedServiceIds('erato_framework.schemifier_field_mapper_register') as $id => $tags) {
				foreach($tags as $tagAttrs) {
					if(isset($tagAttrs)) {
						$registry->addMethodCall(
							'addRegister', array(
								new Reference($id)
							)
						);
					} 
				}
			}

			foreach($container->findTaggedServiceIds('erato_framework.schemifier_field_mapper') as $id => $tags) {
				foreach($tags as $tagAttrs) {
					if(isset($tagAttrs)) {
						$registry->addMethodCall(
							'set', array(
								$tagAttrs['from'],
								$tagAttrs['to'],
								new Reference($id)
							)
						);
					} 
				}
			}
		}
	}
}

