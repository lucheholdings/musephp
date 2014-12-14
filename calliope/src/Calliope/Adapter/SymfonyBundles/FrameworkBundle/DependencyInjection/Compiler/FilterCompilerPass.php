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

		$this->processFilterChainFactory($container);

		$this->processFilterListener($container);
		$this->processFilterListenerFactory($container);
		//$this->processConnectionFilterListener($container);
	}

	protected function processFilterChainFactory(ContainerBuilder $container)
	{
		$filterFactory = $container->findDefinition('calliope_framework.filter_chain_factory'); 

		foreach($container->findTaggedServiceIds('calliope_framework.filter_chain_factory') as $id =>$tags) {
			foreach($tags as $params) {
				switch($params['position']) {
				case 'last':
					$priority = 0;
					break;
				case 'first':
					$priority = 100;
					break;
				default:
					$priority = 50;
					break;
				}

				$filterFactory->addMethodCall(
					'add',
					array(
						new Reference($id),
						$priority
					)
				);
			}
		}
	}

	protected function processFilterListenerFactory($container)
	{
		$registry = $container->findDefinition('calliope_framework.filter_listener_factory_registry');
		foreach($container->findTaggedServiceIds('calliope_framework.filter_listener_factory') as $id => $tags) {
			foreach($tags as $params) {
				$registry->addMethodCall(
					'set',
					array(
						$params['for'],
						$id
					)
				);
			}
		}
	}

	protected function processFilterListener($container)
	{
		foreach($container->findTaggedServiceIds('calliope_framework.filter_listener') as $listenerId => $tags) {
			foreach($tags as $params) {
				$dispatcher = $container->findDefinition($params['dispatcher']);

				$dispatcher->addMethodCall(
					'addFilterListener',
					array(
						//new Reference($listenerId),
						new Reference($listenerId),
						isset($params['priority']) ? $params['priority'] : 100
					));
			}
		}
	}
}

