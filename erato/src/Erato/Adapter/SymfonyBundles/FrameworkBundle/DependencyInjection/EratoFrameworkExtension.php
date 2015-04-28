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

		$this->loader->load('type.xml');
		$this->loader->load('schema.xml');
		$this->loader->load('mapping.xml');

        $this->configureConfigLoader($container);
		$this->configureDefaultMappings($container, $config['mappings']);
		$this->configureCodingRule($container, $config['coding_rules']);
		//$this->configureCacheFactory($container, $config['cache_factory']);
		//$this->configureMetadata($container, $config['metadata']);

		//$this->configureAccessor($container, $config['accessor']);
		$this->configureNormalizer($container, $config['normalizer']);
		//$this->configureSchemifier($container, $config['schemifier']);
		$this->configureSerializer($container, $config['serializer']);
    }

	protected function initParameters($container, $configs)
	{
	}
    
    protected function configureConfigLoader($container)
    {
        // File Format
        $definition = new DefinitionDecorator('erato_framework.schema.config_loader.array_encoded_file.default');
        $definition->replaceArgument(1, array('yaml', 'json'));
        $container->setDefinition('erato_framework.schema.config_loader.array_encoded_file', $definition);

        // Annotation 
        $definition = new DefinitionDecorator('erato_framework.schema.config_loader.annotation.default');
        $container->setDefinition('erato_framework.schema.config_loader.annotation', $definition);

        //$container->setAlias('erato_framework.schema.config_loader', 'erato_framework.schema.config_loader.cache');
        $container->setAlias('erato_framework.schema.config_loader', 'erato_framework.schema.config_loader.collection');
    }

    /**
     * configureCodingRule 
     *   Configure the rule of Convention over Configuration  
     * @param mixed $container 
     * @param mixed $configs 
     * @access protected
     * @return void
     */
	protected function configureCodingRule($container, $configs)
	{
		if($configs['enabled']) {
			$definition = new DefinitionDecorator('erato_framework.coc.default');

			$definition->replaceArgument(0, $configs['naming']);

			$container->setDefinition(
				'erato_framework.coc',
				$definition
			);
		}
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

			$definition = new DefinitionDecorator('erato_framework.schema.config_loader.annotation');
			
			$container->setDefinition('erato_framework.schema.config_loader.annotation', $definition);
			$container->setAlias('erato_framework.schema.config_loader', 'erato_framework.schema.config_loader.annotation');
		}

		$this->configureMetadataCache($container, $configs['cache']);

		if($configs['cache']['enabled']) {
			$container->setAlias('erato_framework.schema.registry.loader', 'erato_framework.schema.registry.cache_loader');
			$container->setParameter('erato_framework.schema.registry.cache_loader.ttl', $configs['cache']['ttl']);
		} else {
			$container->setAlias('erato_framework.schema.registry.loader', 'erato_framework.schema.registry.factory_loader');
		}
	}


	protected function configureMetadataCache($container, array $configs)
	{
		if($configs['enabled']) {
			switch($configs['type']) {
			case 'alias':
				$container->setAlias('erato_framework.schema.registry.cache_loader.cache', $configs['options']['id']);
				break;
			default:
				$cacheDefinition = new DefinitionDecorator('erato_framework.schema.registry.cache_loader.default_cache');

				$options = $configs['options'];
				$cacheDefinition->replaceArgument(0, $configs['type']);
				$cacheDefinition->replaceArgument(1, $options);
			
				$container->setDefinition(
					'erato_framework.schema.registry.cache_loader.cache',
					$cacheDefinition
				);
				break;
			}
		}
	}

	protected function configureDefaultMappings($container, array $mappingConfig)
	{
		$this->configureIdentifierMapping($container, $mappingConfig['identifier']);
		$this->configureAttributesMapping($container, $mappingConfig['attributes']);
		$this->configureTagsMapping($container, $mappingConfig['tags']);
		//$this->configureAccessorMapping($container, $mappingConfig['accessor']);
		//$this->configureNormalizerMapping($container, $mappingConfig['normalizer']);
		//$this->configureSerializerMapping($container, $mappingConfig['serializer']);
		//$this->configureSchemifierMapping($container, $mappingConfig['schemifier']);
		////$this->configureSchemaManagerMapping($container, $mappingConfig['schema_manager']);
		//$this->configureMergerMapping($container, $mappingConfig['merger']);
		//$this->configureReplacerMapping($container, $mappingConfig['replacer']);
	}

	protected function configureAttributesMapping($container, $configs)
	{
		if(isset($configs['enabled'])) {
			$definition = new DefinitionDecorator('erato_framework.schema.mapping_factory.attributes._default');

			$definition->replaceArgument(0, $configs['fieldname']);
			$definition->replaceArgument(1, $configs['default_class']);
			$definition->addMethodCall('setOptions', array($configs['options']));

            // attributes for 
            $definition->addTag('erato_framework.schema.schema_mapping_factory', array('for' => 'attributes'));
			$container->setDefinition(
				'erato_framework.schema.mapping_factory.attributes',
				$definition
			);
		}
	}

	protected function configureTagsMapping($container, $configs)
	{
		if(isset($configs['enabled'])) {
			$definition = new DefinitionDecorator('erato_framework.schema.mapping_factory.tags._default');

			$definition->replaceArgument(0, $configs['fieldname']);
			$definition->replaceArgument(1, $configs['default_class']);
			$definition->addMethodCall('setOptions', array($configs['options']));

            // tags for 
            $definition->addTag('erato_framework.schema.schema_mapping_factory', array('for' => 'tags'));
			$container->setDefinition(
				'erato_framework.schema.mapping_factory.tags',
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

			$definition = new DefinitionDecorator('erato_framework.schema.mapping_factory.accessor._default');
			$definition->addMethodCall('setOptions', array($configs['options']));

			$container->setDefinition(
				'erato_framework.schema.mapping_factory.accessor',
				$definition
			);
		}
	}

	protected function configureNormalizerMapping($container, $configs)
	{
		if($configs['enabled']) {

			$definition = new DefinitionDecorator('erato_framework.schema.mapping_factory.normalizer._default');

			$definition->replaceArgument(1, array('normalizer' => $configs['default_normalizer']));
			$definition->addMethodCall('setOptions', array($configs['options']));


			$container->setDefinition(
				'erato_framework.schema.mapping_factory.normalizer',
				$definition
			);
		}
	}

	protected function configureSerializerMapping($container, $configs)
	{
		if($configs['enabled']) {
			$definition = new DefinitionDecorator('erato_framework.schema.mapping_factory.serializer._default');
			$definition->replaceArgument(1, array('serializer' => $configs['default_serializer']));
			$definition->addMethodCall('setOptions', array($configs['options']));

			$container->setDefinition(
				'erato_framework.schema.mapping_factory.serializer',
				$definition
			);
		}
	}

	protected function configureSchemifierMapping($container, $configs)
	{
		if($configs['enabled']) {

			$definition = new DefinitionDecorator('erato_framework.schema.mapping_factory.schemifier._default');
			$definition->replaceArgument(1, array('factory' => $configs['default_factory']));
			$definition->addMethodCall('setOptions', array($configs['options']));

			$container->setDefinition(
				'erato_framework.schema.mapping_factory.schemifier',
				$definition
			);
		}
	}

	protected function configureSchemaManagerMapping($container, $configs)
	{
		if($configs['enabled']) {
			$this->getLoader()->load('manager.xml');

			$definition = new DefinitionDecorator('erato_framework.schema.mapping_factory.schema_manager._default');

			$definition->replaceArgument(0, new Reference($configs['factory_service']));
			$definition->replaceArgument(1, $configs['default_class']);
			$definition->addMethodCall('setOptions', array($configs['options']));

			$container->setDefinition(
				'erato_framework.schema.mapping_factory.schema_manager',
				$definition
			);
		}
	}


	protected function configureIdentifierMapping($container, $configs)
	{
		if(isset($configs['enabled'])) {
			$definition = new DefinitionDecorator('erato_framework.schema.mapping_factory.identifier._default');
			$definition->addMethodCall('setOptions', array($configs['options']));

            // identifier for 
            $definition->addTag('erato_framework.schema.schema_mapping_factory', array('for' => 'identifier'));
			$container->setDefinition(
				'erato_framework.schema.mapping_factory.identifier',
				$definition
			);
		}
	}

	protected function configureMergerMapping($container, $configs)
	{
		if(isset($configs['enabled'])) {

			$definition = new DefinitionDecorator('erato_framework.schema.mapping_factory.merger._default');
			$definition->addMethodCall('setOptions', array($configs['options']));

			$container->setDefinition(
				'erato_framework.schema.mapping_factory.merger',
				$definition
			);
		}
	}

	protected function configureReplacerMapping($container, $configs)
	{
		if(isset($configs['enabled'])) {

			$definition = new DefinitionDecorator('erato_framework.schema.mapping_factory.replacer._default');
			$definition->addMethodCall('setOptions', array($configs['options']));

			$container->setDefinition(
				'erato_framework.schema.mapping_factory.replacer',
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

	//protected function configureCoder($container, $configs)
	//{
	//	if($configs['enabled']) {
	//		// If configuration enabled, then load serializer.xml
	//		$this->getLoader()->load('coder.xml');

	//		foreach($configs['format'] as $name => $coderConfig) {
	//			if($coderConfig['enabled']) {
	//				$coderDefinition = new DefinitionDecorator($coderConfig['id']);
	//				$coderDefinition->addTag('erato_framework.coder', array('for' => $name));
	//				
	//				$container->setDefinition(
	//					'erato_framework.coder.' . $name,
	//					$coderDefinition
	//				);
	//			}
	//		}
	//	}
	//}

	protected function configureSerializer($container, $configs)
	{
		if($configs['enabled']) {

			// If configuration enabled, then load serializer.xml
			$this->getLoader()->load('serializer.xml');

			foreach($configs['strategies'] as $name => $strategyConfig) {
				if($strategyConfig['enabled']) {
					$strategyDefinition = new DefinitionDecorator($strategyConfig['id']);
					$strategyDefinition->addTag('erato_framework.serializer.strategy', array('priority' => $strategyConfig['priority']));
					
					$container->setDefinition(
						'erato_framework.serializer.strategy.' . $name,
						$strategyDefinition
					);
				}
			}
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
}
