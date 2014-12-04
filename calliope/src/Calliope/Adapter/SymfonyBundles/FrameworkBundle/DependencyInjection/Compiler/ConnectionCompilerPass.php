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
class ConnectionCompilerPass implements CompilerPassInterface
{
	public function process(ContainerBuilder $container)
	{
		$this->processConnectionFactory($container);
	}

	protected function processConnectionFactory($container)
	{
		$registry = $container->findDefinition('calliope_framework.connection_factory.collection');
		if(!$registry) {
			throw new \RuntimeException('"calliope_framework.connection_factory.collection" is not defined.');
		}

		foreach($container->findTaggedServiceIds('calliope_framework.connection_factory') as $id => $tags) {
			foreach($tags as $tagAttrs) {
				if(isset($tagAttrs)) {
					//  
					$registry->addMethodCall(
						'setConnectionFactory', array(
							$tagAttrs['for'],
							new Reference($id)
						)
					);
				} 
			}
		}
	}
}

