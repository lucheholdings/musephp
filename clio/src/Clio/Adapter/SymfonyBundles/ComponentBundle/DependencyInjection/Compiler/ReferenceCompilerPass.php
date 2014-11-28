<?php
namespace Clio\Adapter\SymfonyBundles\ComponentBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
	Symfony\Component\DependencyInjection\Definition,
	Symfony\Component\DependencyInjection\Reference;

class ReferenceCompilerPass implements CompilerPassInterface 
{
	public function process(ContainerBuilder $container)
	{
		foreach($container->findTaggedServiceIds('clio_component.reference') as $id => $tags) {
			// once delete the definition
			$definition = $container->getDefinition($id);
			$container->removeDefinition($id);

			$container->setDefinition($id . '._actual', $definition);

			if(1 < count($tags)) {
				throw new \RuntimeException('tag "clio_component.reference" only accept 1 tag for each service');
			}

			$params = array_shift($tags);

			// now create Reference object
			$class = 'Clio\Adapter\SymfonyBundles\ComponentBundle\DependencyInjection\ServiceReference';
			if(isset($params['class'])) {
				$class = $params['class'];
			}
			$referenceDefinition = new Definition($class);
			$referenceDefinition->addMethodCall('_setContainer', array(new Reference('service_container')));
			$referenceDefinition->addMethodCall('_setServiceId', array($id . '._actual'));

			$container->setDefinition($id, $referenceDefinition);
			
		}
	}
}

