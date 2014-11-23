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
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

		$loader->load('normalizer.xml');

		$this->configureNormalizer($container, $config['normalizer']);
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
}
