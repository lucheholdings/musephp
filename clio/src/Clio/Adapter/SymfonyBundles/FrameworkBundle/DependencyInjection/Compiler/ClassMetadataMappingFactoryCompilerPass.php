<?php
namespace Clio\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler;

// Symfony DI Components
use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
	Symfony\Component\DependencyInjection\Definition,
	Symfony\Component\DependencyInjection\Reference;

/**
 * ClassMetadataMappingFactoryCompilerPass 
 * 
 * @uses CompilerPassInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ClassMetadataMappingFactoryCompilerPass implements CompilerPassInterface 
{
	/**
	 * process 
	 * 
	 * @param ContainerBuilder $container 
	 * @access public
	 * @return void
	 */
	public function process(ContainerBuilder $container)
	{
		if(!$container->hasDefinition('clio_framework.class_metadata_factory.default')) {
			return;
		}

		$factory= $container->getDefinition('clio_framework.class_metadata_factory.default');

		foreach($container->findTaggedServiceIds('clio_framework.class_metadata_mapping_factory') as $id => $tags) {
			foreach($tags as $tag) {

				$factory->addMethodCall(
					'addMappingFactory',
					array(new Reference($id), isset($tag['for']) ? $tag['for'] : null)
				);
			}
		}
	}
}

