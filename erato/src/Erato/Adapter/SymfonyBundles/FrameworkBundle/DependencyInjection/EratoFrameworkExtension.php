<?php

namespace Erato\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection;

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
class EratoFrameworkExtension extends Extension
{
	private $loader;

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

		$this->initParameters($container, $config);

        $this->loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $this->loader->load('services.xml');

		$this->loader->load('metadata.xml');
		$this->loader->load('mapping.xml');

		$this->configureCacheFactory($container, $config['cache_factory']);
		$this->configureMetadata($container, $config['metadata']);
		//$this->configureSchema($configs['schema']);
		$this->configureMapping($container, $config['mappings']);

		$this->configureAccessor($container, $config['accessor']);
		//$this->configureFormat();
		//$this->configureMetadata($container, $config['metadata']);
		////$this->configureCounter($container, $config['counter']);
		////$this->configureKvs($container, $config['kvs']);
		////$this->configureSerializer($container, $config['serializer']);
		////$this->configureFieldAccessor($container, $config['field_accessor']);
		////$this->configureClassMetadata($container, $config['class_metadata']);

		////$this->configureJMSSerializer($container, $config['jms_serializer']);
		$this->configureNormalizer($container, $config['normalizer']);
		$this->configureSchemifier($container, $config['schemifier']);
    }

	protected function initParameters($container, $configs)
	{
	}

	protected function configureCacheFactory($container, $configs)
	{
		if(isset($configs['enabled'])) {
			// Alias the cache provider factory
			$container->setAlias('erato_framework.cache_factory', $configs['id']);
		}
	}

	protected function configureMetadata($container, array $configs)
	{
		// configure loader
		{
			$loaders = (array) $configs['config_loader'];

			$definition = new DefinitionDecorator('erato_framework.metadata.default_config_loader.annotation');
			
			$container->setDefinition('erato_framework.metadata.config_loader.annotation', $definition);
			$container->setAlias('erato_framework.metadata.config_loader', 'erato_framework.metadata.config_loader.annotation');
		}

		$this->configureMetadataCache($container, $configs['cache']);

		if($configs['cache']['enabled']) {
			$container->setAlias('erato_framework.metadata.registry.loader', 'erato_framework.metadata.registry.cache_loader');
			$container->setParameter('erato_framework.metadata.registry.cache_loader.ttl', $configs['cache']['ttl']);
		} else {
			$container->setAlias('erato_framework.metadata.registry.loader', 'erato_framework.metadata.registry.factory_loader');
		}
	}


	protected function configureMetadataCache($container, array $configs)
	{
		if($configs['enabled']) {
			switch($configs['type']) {
			case 'alias':
				$container->setAlias('erato_framework.metadata.registry.cache_loader.cache', $configs['options']['id']);
				break;
			default:
				$cacheDefinition = new DefinitionDecorator('erato_framework.metadata.registry.cache_loader.default_cache');

				$options = $configs['options'];
				$cacheDefinition->replaceArgument(0, $configs['type']);
				$cacheDefinition->replaceArgument(1, $options);
			
				$container->setDefinition(
					'erato_framework.metadata.registry.cache_loader.cache',
					$cacheDefinition
				);
				break;
			}
		}
	}

	protected function configureMapping($container, array $mappingConfig)
	{
		$this->configureAttributeMapMapping($container, $mappingConfig['attribute_map']);
		$this->configureTagSetMapping($container, $mappingConfig['tag_set']);
		$this->configureAccessorMapping($container, $mappingConfig['accessor']);
		$this->configureNormalizerMapping($container, $mappingConfig['normalizer']);
		$this->configureSerializerMapping($container, $mappingConfig['serializer']);
		$this->configureSchemifierMapping($container, $mappingConfig['schemifier']);
		$this->configureSchemaManagerMapping($container, $mappingConfig['schema_manager']);
	}

	protected function configureAttributeMapMapping($container, $configs)
	{
		if(isset($configs['enabled'])) {
			$definition = new DefinitionDecorator('erato_framework.metadata.default_mapping_factory.attribute_map');

			$definition->replaceArgument(0, $configs['fieldname']);
			$definition->replaceArgument(1, $configs['default_class']);
			$definition->addMethodCall('setOptions', array($configs['options']));

			$this->enableMapping($definition, 'attribute_map');

			$container->setDefinition(
				'erato_framework.metadata.mapping_factory.attribute_map',
				$definition
			);
		}
	}

	protected function configureTagSetMapping($container, $configs)
	{
		if(isset($configs['enabled'])) {
			$definition = new DefinitionDecorator('erato_framework.metadata.default_mapping_factory.tag_set');

			$definition->replaceArgument(0, $configs['fieldname']);
			$definition->replaceArgument(1, $configs['default_class']);
			$definition->addMethodCall('setOptions', array($configs['options']));

			$this->enableMapping($definition, 'tag_set');

			$container->setDefinition(
				'erato_framework.metadata.mapping_factory.tag_set',
				$definition
			);
		}
	}

	/**
	 * configureAccessor 
	 * 
	 * @param mixed $container 
	 * @param mixed $configs 
	 * @access protected
	 * @return void
	 */
	protected function configureAccessorMapping($container, $configs)
	{
		if(isset($configs['enabled'])) {

			$definition = new DefinitionDecorator('erato_framework.metadata.default_mapping_factory.accessor');
			$definition->addMethodCall('setOptions', array($configs['options']));

			$this->enableMapping($definition, 'accessor');

			$container->setDefinition(
				'erato_framework.metadata.mapping_factory.accessor',
				$definition
			);
		}
	}

	protected function configureNormalizerMapping($container, $configs)
	{
		if($configs['enabled']) {

			$definition = new DefinitionDecorator('erato_framework.metadata.default_mapping_factory.normalizer');

			$definition->replaceArgument(1, array('normalizer' => $configs['default_normalizer']));
			$definition->addMethodCall('setOptions', array($configs['options']));

			$this->enableMapping($definition, 'normalizer');


			$container->setDefinition(
				'erato_framework.metadata.mapping_factory.normalizer',
				$definition
			);
		}
	}

	protected function configureSerializerMapping($container, $configs)
	{
		if($configs['enabled']) {
			$definition = new DefinitionDecorator('erato_framework.metadata.default_mapping_factory.serializer');
			$definition->replaceArgument(1, array('serializer' => $configs['default_serializer']));
			$definition->addMethodCall('setOptions', array($configs['options']));

			$this->enableMapping($definition, 'serializer');

			$container->setDefinition(
				'erato_framework.metadata.mapping_factory.serializer',
				$definition
			);
		}
	}

	protected function configureSchemifierMapping($container, $configs)
	{
		if($configs['enabled']) {

			$definition = new DefinitionDecorator('erato_framework.metadata.default_mapping_factory.schemifier');
			$definition->replaceArgument(1, array('factory' => $configs['default_factory']));
			$definition->addMethodCall('setOptions', array($configs['options']));

			$this->enableMapping($definition, 'schemifier');

			$container->setDefinition(
				'erato_framework.metadata.mapping_factory.schemifier',
				$definition
			);
		}
	}

	protected function configureSchemaManagerMapping($container, $configs)
	{
		if($configs['enabled']) {
			$this->getLoader()->load('manager.xml');

			$definition = new DefinitionDecorator('erato_framework.metadata.default_mapping_factory.schema_manager');

			$definition->replaceArgument(0, new Reference($configs['factory_service']));
			$definition->replaceArgument(1, $configs['default_class']);
			$definition->addMethodCall('setOptions', array($configs['options']));

			$this->enableMapping($definition, 'schema_manager');

			$container->setDefinition(
				'erato_framework.metadata.mapping_factory.schema_manager',
				$definition
			);
		}
	}


	protected function configureAccessor($contianer, $configs)
	{
		if(isset($configs['enabled']) && $configs['enabled']) {
			// If configuration enabled, then load 
			$this->getLoader()->load('accessor.xml');
		}
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

			$strategies = array(
				'accessor'  => array('enabled' => true, 'id' => null, 'priority' => 0, 'options' => array()),
			);

			$strategies = array_merge($strategies, $configs['strategies']);
			foreach($strategies as $name => $strategyConfig) {
				if(!isset($strategyConfig['id'])) {
					$definition = new DefinitionDecorator('erato_framework.normalizer.default_strategy.' . $name);
				} else {
					$definition = new DefinitionDecorator($strategyConfig['id']);
				}

				// Set options
				if(isset($strategyConfig['options'])) {
					$definition->addMethodCall('setOptions', array($strategyConfig['options']));
				}

				$definition->addTag('erato_framework.normalizer.strategy', array(
					'for'      => $name,
					'priority' => $strategyConfig['priority'] ? : 100,
				));


				$container->setDefinition(
					'erato_framework.normalizer.strategy.' . $name,
					$definition
				);
			}
		}
	}

	protected function configureSerializer($container, $configs)
	{
		if($configs['enabled']) {
			// If configuration enabled, then load serializer.xml
			$this->getLoader()->load('serializer.xml');

			// Map Strategy
			$container->setAlias(
				'erato_framework.serializer_strategy',
				$configs['strategy']
			);
		}
	}

	protected function configureSchemifier($container, $configs)
	{
		if($configs['enabled']) {
			$this->getLoader()->load('schemifier.xml');
		
			// 
			//$container->setAlias(
			//	'erato_framework.schemifier_factory',
			//	$configs['default_factory']
			//);
		}
	}

	public function configureKvs($container, array $configs)
	{
		if(isset($configs['enabled'])) {
			$this->getLoader()->load('kvs.xml');

			// Initialize Registry
			$container->setAlias('erato_framework.kvs_registry', $configs['registry']);
			
			// Add Services
			foreach($configs['services'] as $name => $kvsConfigs) {
				$args = $kvsConfigs['arguments'];
				array_push($args, $kvsConfigs['options']);

				// check cache is enabled or not.
				$definition = new DefinitionDecorator('erato_framework.kvs_prototype');
				$definition
					->replaceArgument(0, $kvsConfigs['type'])
					->replaceArgument(1, isset($kvsConfigs['cache']) ? $kvsConfigs['cache'] : null)
					->replaceArgument(2, $args)
					->setPublic(true)
					->setAbstract(false)
				;

				$definition->addTag('erato_framework.kvs', array('for' => $name));

				$container->setDefinition('erato_framework.kvs.' . $name, $definition);
			}
		}
	}

	public function configureCounter($container, array $configs)
	{
		if(isset($configs['enabled'])) {
			$this->getLoader()->load('counter.xml');

			// Initialize Registry
			$container->setAlias('erato_framework.counter_registry', $configs['registry']);
			
			// Add Services
			foreach($configs['services'] as $name => $counterConfigs) {
				$definition = new DefinitionDecorator('erato_framework.counter_prototype');

				$definition
					->replaceArgument(0, $counterConfigs['type'])
					->replaceArgument(1, $counterConfigs['arguments'])
					->setPublic(true)
					->setAbstract(false)
				;

				$definition->addTag('erato_framework.counter', array('for' => $name));

				$container->setDefinition('erato_framework.counter.' . $name, $definition);
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

	/**
	 * enableMapping 
	 * 
	 * @param mixed $definition 
	 * @param mixed $name 
	 * @access protected
	 * @return void
	 */
	protected function enableMapping($definition, $name)
	{
		$definition->addTag('erato_framework.metadata.mapping_factory', array('for' => $name));
	}
}
