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
		$this->processConnectionFilterListener($container);
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
		$factoryMap = $container->findDefinition('calliope_framework.filter_listener_factory_collection');
		foreach($container->findTaggedServiceIds('calliope_framework.filter_listener_factory') as $id => $tags) {
			foreach($tags as $params) {
				$factoryMap->addMethodCall(
					'set',
					array(
						$params['for'],
						new Reference($id)
					)
				);
			}
		}
	}

	protected function processFilterListener($container)
	{
		$registry = $container->findDefinition('calliope_framework.filter_listener_registry');

		foreach($container->findTaggedServiceIds('calliope_framework.filter_listener') as $filterId => $tags) {
			foreach($tags as $params) {

				// Set alias for the filterListener services
				$registry->addMethodCall(
					'set',
					array(
						$params['for'],
						$filterId
					)
				);
			}
		}
	}

	protected function processConnectionFilterListener($container)
	{
		foreach($container->findTaggedServiceIds('calliope_framework.connection_filter_listener') as $listenerId => $tags) {
			foreach($tags as $params) {
				// Get Dispatcher Connection
				$dispatcher = $container->getDefinition($params['dispatcher']);

				$priority = 0;
				if(isset($params['priority'])) 
					$priority = $params['priority'];

				$dispatcher->addMethodCall('addFilterListener', array(
					new Reference($listenerId), 
					$priority
				));
			}
		}
	}
}

