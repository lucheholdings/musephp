<?php
namespace Erato\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler;

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
		$this->processClassMetadataFactory($container);
		$this->processMappingFactory($container);
	}

	protected function processClassMetadataFactory($container)
	{
		if($container->hasDefinition('erato_framework.schema.loader_collection')) {
			// Inject with tag "erato_framework.schema.loader"
			$loaderCollection = $container->getDefinition('erato_framework.schema.loader_collection');

			foreach($container->findTaggedServiceIds('erato_framework.schema.loader') as $id => $tags) {
				foreach($tags as $tag) {
					$loaderCollection->addMethodCall(
						'addLoader',
						array(new Reference($id))
					);
				}
			}
		}
	}

	protected function processMappingFactory($container)
	{
		if($container->hasDefinition('erato_framework.schema.mapping_factory.collection')) {
			$collection = $container->getDefinition('erato_framework.schema.mapping_factory.collection');

			foreach($container->findTaggedServiceIds('erato_framework.schema.mapping_factory') as $id => $tags) {
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

