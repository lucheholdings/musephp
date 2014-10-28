<?php
namespace Clio\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler;

// Symfony DI Components
use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
	Symfony\Component\DependencyInjection\Definition,
	Symfony\Component\DependencyInjection\Reference;

/**
 * CacheCompilerPass 
 * 
 * @uses CompilerPassInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class CacheCompilerPass implements CompilerPassInterface 
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
		$this->processCacheFactory($container);
	}

	protected function processCacheFactory($container)
	{
		if($container->hasDefinition('clio_framework.cache.factory.collection')) {
			// Inject with tag "clio_framework.metadata.loader"
			$registry = $container->getDefinition('clio_framework.cache.factory.collection');

			foreach($container->findTaggedServiceIds('clio_framework.cache.factory') as $id => $tags) {
				foreach($tags as $tag) {
					$registry->addMethodCall(
						'set',
						array($tag['for'], new Reference($id))
					);
				}
			}
		}
	}
}

