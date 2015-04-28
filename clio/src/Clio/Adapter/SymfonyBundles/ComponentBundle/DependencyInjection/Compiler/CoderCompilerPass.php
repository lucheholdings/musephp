<?php
namespace Clio\Adapter\SymfonyBundles\ComponentBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
	Symfony\Component\DependencyInjection\Definition,
	Symfony\Component\DependencyInjection\Reference;

class CoderCompilerPass implements CompilerPassInterface 
{
	public function process(ContainerBuilder $container)
	{
		if($container->hasDefinition('clio_component.coders')) {
			$coders = $container->getDefinition('clio_component.coders');

			foreach($container->findTaggedServiceIds('clio_component.coder') as $id => $tags) {
                foreach($tags as $opts) {
				    $coders->addMethodCall('set', array($opts['for'], new Reference($id)));
                }
			}
		}
	}
}

