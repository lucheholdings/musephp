<?php
namespace Calliope\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler;

// Symfony DI Components
use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
	Symfony\Component\DependencyInjection\Definition,
	Symfony\Component\DependencyInjection\Reference;

/**
 * MetadataCompilerPass 
 * 
 * @uses CompilerPassInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MetadataCompilerPass implements CompilerPassInterface 
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
		$this->processMappingFactory($container);
	}

	protected function processMappingFactory($container)
	{
		if($container->hasDefinition('calliope_framework.metadata.mapping_factory.collection')) {
			$collection = $container->getDefinition('calliope_framework.metadata.mapping_factory.collection');

			foreach($container->findTaggedServiceIds('calliope_framework.metadata.mapping_factory') as $id => $tags) {
				foreach($tags as $tag) {
					$collection->addMethodCall(
						'set',
						array($tag['for'], new Reference($id))
					);
				}
			}
		}
	}
}

