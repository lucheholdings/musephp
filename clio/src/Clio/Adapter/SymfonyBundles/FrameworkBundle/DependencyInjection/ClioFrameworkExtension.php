<?php

namespace Clio\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ClioFrameworkExtension extends Extension
{
	private $loader;

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $this->loader->load('services.xml');

		$this->configureFormat();
		$this->configureCounter($container, $config['counter']);
		$this->configureKvs($container, $config['kvs']);
		$this->configureNormalizer($container, $config['normalizer']);
		$this->configureSerializer($container, $config['serializer']);
		$this->configureSchemifier($container, $config['schemifier']);
		$this->configureFieldAccessor($container, $config['field_accessor']);
		$this->configureClassMetadata($container, $config['class_metadata']);

		$this->configureJMSSerializer($container, $config['jms_serializer']);
    }

	/**
	 * configureFormat 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function configureFormat()
	{
		$this->getLoader()->load('format.xml');
	}

	protected function configureNormalizer($container, $configs)
	{
		if($configs['enabled']) {
			// If configuration enabled, then load serializer.xml
			$this->getLoader()->load('normalizer.xml');

			// Map Strategy
			$container->setAlias(
				'clio_framework.normalizer_strategy',
				$configs['strategy']
			);
		}
	}

	protected function configureSerializer($container, $configs)
	{
		if($configs['enabled']) {
			// If configuration enabled, then load serializer.xml
			$this->getLoader()->load('serializer.xml');

			// Map Strategy
			$container->setAlias(
				'clio_framework.serializer_strategy',
				$configs['strategy']
			);
		}
	}

	protected function configureSchemifier($container, $configs)
	{
		if($configs['enabled']) {
			$this->getLoader()->load('schemifier.xml');
		
			// 
			$container->setAlias(
				'clio_framework.schemifier_factory',
				$configs['factory_id']
			);
		}
	}

	protected function configureClassMetadata($container, $configs)
	{
		if($configs['enabled']) {
			$this->getLoader()->load('class_metadata.xml');

			$container->setAlias(
				'clio_framework.class_metadata_factory',
				$configs['factory_id']
			);

			foreach($configs['default_mapping_factories'] as $type => $isEnabled) {

				if($isEnabled) {
					$definition = new DefinitionDecorator('clio_framework.class_metadata_mapping_factory.' . $type . '.default');
					
					$definition->addTag(
						'clio_framework.class_metadata_mapping_factory'
					);

					$container->setDefinition(
						'clio_framework.class_metadata_mapping_factory.' . $type,
						$definition
					);
				}
			}
		}
	}

	protected function configureFieldAccessor($container, $configs)
	{
		if(isset($configs['enabled'])) {
			// If configuration enabled, then load serializer.xml
			$this->getLoader()->load('field_accessor.xml');

		}
	}
	protected function configureJMSSerializer($container, $configs)
	{
		if(isset($configs['enabled'])) {

			$this->getLoader()->load('jms_serializer.xml');
			foreach($configs['handlers'] as $name => $enableHandler) {
				if($enableHandler) {
					$definition = new DefinitionDecorator('clio_framework.jms_serializer_handler.' . $name . '.default');
					$definition->addTag('jms_serializer.subscribing_handler');
					$container->setDefinition(
						'clio_framework.jms_serializer_handler.' . $name,
						$definition
					);
				}
			}

			foreach($configs['listeners'] as $name => $enableHandler) {
				if($enableHandler) {
					$definition = new DefinitionDecorator('clio_framework.jms_serializer_event_subscriber.' . $name . '.default');
					$definition->addTag('jms_serializer.event_subscriber');
					$container->setDefinition(
						'clio_framework.jms_serializer_event_subscriber.' . $name,
						$definition
					);
				}
			}
		}
	}

	public function configureKvs($container, array $configs)
	{
		if(isset($configs['enabled'])) {
			$this->getLoader()->load('kvs.xml');

			// Initialize Registry
			$container->setAlias('clio_framework.kvs_registry', $configs['registry']);
			
			// Add Services
			foreach($configs['services'] as $name => $kvsConfigs) {
				$args = $kvsConfigs['arguments'];
				array_push($args, $kvsConfigs['options']);

				// check cache is enabled or not.
				$definition = new DefinitionDecorator('clio_framework.kvs_prototype');
				$definition
					->replaceArgument(0, $kvsConfigs['type'])
					->replaceArgument(1, isset($kvsConfigs['cache']) ? $kvsConfigs['cache'] : null)
					->replaceArgument(2, $args)
					->setPublic(true)
					->setAbstract(false)
				;

				$definition->addTag('clio_framework.kvs', array('for' => $name));

				$container->setDefinition('clio_framework.kvs.' . $name, $definition);
			}
		}
	}

	public function configureCounter($container, array $configs)
	{
		if(isset($configs['enabled'])) {
			$this->getLoader()->load('counter.xml');

			// Initialize Registry
			$container->setAlias('clio_framework.counter_registry', $configs['registry']);
			
			// Add Services
			foreach($configs['services'] as $name => $counterConfigs) {
				$definition = new DefinitionDecorator('clio_framework.counter_prototype');

				$definition
					->replaceArgument(0, $counterConfigs['type'])
					->replaceArgument(1, $counterConfigs['arguments'])
					->setPublic(true)
					->setAbstract(false)
				;

				$definition->addTag('clio_framework.counter', array('for' => $name));

				$container->setDefinition('clio_framework.counter.' . $name, $definition);
			}
		}
	}
    
    /**
     * Get loader.
     *
     * @access public
     * @return loader
     */
    public function getLoader()
    {
        return $this->loader;
    }
    
    /**
     * Set loader.
     *
     * @access public
     * @param loader the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setLoader($loader)
    {
        $this->loader = $loader;
        return $this;
    }
}
