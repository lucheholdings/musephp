<?php
namespace Calliope\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler;

// Symfony DI Components
use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
	Symfony\Component\DependencyInjection\Definition,
	Symfony\Component\DependencyInjection\Reference;

/**
 * SchemaManagerCompilerPass 
 * 
 * @uses CompilerPassInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SchemaManagerCompilerPass implements CompilerPassInterface
{
	public function process(ContainerBuilder $container)
	{
		//$classnameRegistry = $container->findDefinition('calliope_framework.schema_manager_registry_by_classname');
		$registry = $container->findDefinition('calliope_framework.schema_manager_registry');


		foreach($container->findTaggedServiceIds('calliope_framework.schema_manager') as $id => $tags) {
			foreach($tags as $tagAttrs) {
				if(isset($tagAttrs['for'])) {
					// Warning:
					// Do not pass the reference of the manager.
					// If it dose, the factory of type "model", proxy connection, will be affected.
					//$registry->addMethodCall(
					//	'addSchemaManager', 
					//	array(
					//		new Reference($id),
					//		$tagAttrs['for'],
					//	)
					//);

					// Map Classname with ServiceId
					//$classnameRegistry->addMethodCall(
					//	'setAlias',
					//	array(
					//		$tagAttrs['for'],
					//		$id
					//	)
					//);
					//
					//// Map Alias with Classnmae
					//if(isset($tagAttrs['alias'])) {
					//	$registry->addMethodCall(
					//		'setAlias',
					//		array(
					//			$tagAttrs['alias'],
					//			$tagAttrs['for'], 
					//		)
					//	);
					//}

					$registry->addMethodCall(
						'setAlias',
						array(
							$tagAttrs['for'],
							$id
						)
					);
				}
			} 
		}
	}
}

