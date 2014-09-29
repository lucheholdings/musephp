<?php
namespace Calliope\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler;

// Symfony DI Components
use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
	Symfony\Component\DependencyInjection\Definition,
	Symfony\Component\DependencyInjection\Reference;

/**
 * FilterFactoryCompilerPass 
 * 
 * @uses CompilerPassInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FilterFactoryCompilerPass implements CompilerPassInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function process(ContainerBuilder $container)
	{

		if($container->hasDefinition('calliope_framework.typed_filter_factory')) {
			$registry = $container->findDefinition('calliope_framework.typed_filter_factory');

			foreach($container->findTaggedServiceIds('calliope_framework.filter_factory') as $id => $tags) {
				foreach($tags as $tagAttrs) {
					if(isset($tagAttrs['for'])) {
						$registry->addMethodCall(
							'setFilterFactory', 
							array(
								$tagAttrs['for'],
								new Reference($id),
							)
						);
					}
				} 
			}
		}
	}
}

