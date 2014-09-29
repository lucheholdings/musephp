<?php
namespace Calliope\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler;

// Symfony DI Components
use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
	Symfony\Component\DependencyInjection\Definition,
	Symfony\Component\DependencyInjection\Reference;

/**
 * FilterCompilerPass 
 * 
 * @uses CompilerPassInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FilterCompilerPass implements CompilerPassInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function process(ContainerBuilder $container)
	{

		$registry = $container->findDefinition('calliope_framework.filter_registry');

		foreach($container->findTaggedServiceIds('calliope_framework.filter') as $id => $tags) {
			foreach($tags as $tagAttrs) {
				$registry->addMethodCall(
					'setAlias', 
					array(
						isset($tagAttrs['for']) ? $tagAttrs['for'] : $id,
						$id,
					)
				);
			} 
		}
	}
}

