<?php

namespace Clio\Adapter\SymfonyBundles\JMSAdapterBundle\DependencyInjection;

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
class ClioJMSAdapterExtension extends Extension
{
	private $loader;

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->loader = $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

		// Adapter for JMSSerializer
		$this->configureSerializer($container, $config['serializer']);
    }

	protected function configureSerializer($container, $configs)
	{
		if(isset($configs['enabled'])) {
			$this->getLoader()->load('serializer.xml');
			foreach($configs['handlers'] as $name => $enableHandler) {
				if($enableHandler) {
					$definition = new DefinitionDecorator('clio_jms_adapter.serializer.handler.' . $name . '.default');
					$definition->addTag('jms_serializer.subscribing_handler');
					$container->setDefinition(
						'clio_jms_adapter.serializer.handler.' . $name,
						$definition
					);
				}
			}

			foreach($configs['listeners'] as $name => $enableHandler) {
				if($enableHandler) {
					$definition = new DefinitionDecorator('clio_jms_adapter.serializer.event_subscriber.' . $name . '.default');
					$definition->addTag('jms_serializer.event_subscriber');
					$container->setDefinition(
						'clio_jms_adapter.serializer.event_subscriber.' . $name,
						$definition
					);
				}
			}
		}
	}
    
    public function getLoader()
    {
        return $this->loader;
    }
}
