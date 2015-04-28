<?php

namespace Clio\Adapter\SymfonyBundles\ComponentBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\DefinitionDecorator;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ClioComponentExtension extends Extension
{
	private $loader;
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $this->loader->load('services.xml');

		$this->loader->load('cache.xml');
		$this->loader->load('normalizer.xml');

        // import coders
		$this->loader->load('coders.xml');
		$this->loader->load('types.xml');

		$this->configureCache($container, $config['cache']);
		$this->configureNormalizer($container, $config['normalizer']);
		$this->configureTask($container, $config['task']);
    }

	protected function configureCache($container, array $configs = array())
	{
		$container->setAlias('clio_component.cache.factory', $configs['default_cache_factory']);
		$container->setAlias('clio_component.cache.provider_factory', $configs['default_cache_provider_factory']);
	}

	protected function configureNormalizer($container, array $configs = array())
	{
		if(isset($configs['strategies'])) {
			foreach($configs['strategies'] as $name => $strategyConfig) {
				if($strategyConfig['enabled']) {
					$definition = new DefinitionDecorator($strategyConfig['id']);

					$definition->setPublic(true);
					
					$definition
						->addTag('clio_component.normalizer.strategy', array('priority' => $strategyConfig['priority']))
					;

					$container->setDefinition('clio_component.normalizer.strategy.' . $name, $definition);
				}
			}
		}
	}

	protected function configureTask($container, array $configs = array())
	{
		if($configs['enabled']) {
			$this->loader->load('task.xml');

			$manager = $container->getDefinition('clio_component.task_manager');
			$manager->addMethodCall('setDefaultScheduleType', array($configs['default_scheduler']));

			foreach($configs['executors'] as $name => $executorConfig) {
				$container->getDefinition($executorConfig['id'])->addTag('clio_component.task_executor', array('alias' => $name));
			}

			foreach($configs['schedulers'] as $name => $schedulerConfig) {
				$container->getDefinition($schedulerConfig['id'])->addTag('clio_component.task_scheduler', array('alias' => $name));
			}
		}
	}
}
