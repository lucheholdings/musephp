<?php
namespace Calliope\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler;

// Symfony DI Components
use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
	Symfony\Component\DependencyInjection\Definition,
	Symfony\Component\DependencyInjection\Reference;

/**
 * ConnectionFactoryCompilerPass:w
 * 
 * @uses CompilerPassInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TypeConnectionFactoryCompilerPass implements CompilerPassInterface
{
	public function process(ContainerBuilder $container)
	{
		$registry = $container->findDefinition('calliope_framework.type_connection_factory');
		if(!$registry) {
			throw new \RuntimeException('"calliope_framework.typed_connection_factory" is not defined.');
		}

		foreach($container->findTaggedServiceIds('calliope_framework.type_connection_factory') as $id => $tags) {
			foreach($tags as $tagAttrs) {
				if(isset($tagAttrs)) {
					//  
					$registry->addMethodCall(
						'setTypeConnectionFactory', array(
							$tagAttrs['type'],
							new Reference($id)
						)
					);
				} 
			}
		}
	}
}

