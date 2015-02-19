<?php
namespace Clio\Adapter\SymfonyBundles\ComponentBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
	Symfony\Component\DependencyInjection\Definition,
	Symfony\Component\DependencyInjection\Reference;

class TaskCompilerPass implements CompilerPassInterface 
{
	public function process(ContainerBuilder $container)
	{
		if($container->hasDefinition('clio_component.task_manager')) {
			$manager = $container->getDefinition('clio_component.task_manager');
			$this->processScheduler($container, $manager);
			$this->processExecutor($container, $manager);
		}
	}

	protected function processScheduler(ContainerBuilder $container, $manager)
	{
		foreach($container->findTaggedServiceIds('clio_component.task_scheduler') as $id => $tags) {
			foreach($tags as $tagParams) {
				$manager
					->addMethodCall(
						'addScheduler',
						array($tagParams['alias'], new Reference($id))
					);
			}
		}
	}

	protected function processExecutor(ContainerBuilder $container, $manager)
	{
		foreach($container->findTaggedServiceIds('clio_component.task_executor') as $id => $tags) {
			foreach($tags as $tagParams) {
				$manager
					->addMethodCall(
						'setExecutor',
						array($tagParams['alias'], new Reference($id))
					);
			}
		}
	}

}
