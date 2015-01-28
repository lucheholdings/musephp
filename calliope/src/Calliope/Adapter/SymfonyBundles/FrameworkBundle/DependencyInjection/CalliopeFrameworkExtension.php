<?php

namespace Calliope\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerInterface;


use Clio\Extra\Loader as ClioLoader;
use Clio\Component\Util as ClioUtil;
use Clio\Component\Exception\ResourceNotFoundException;
use Clio\Bridge\SymfonyComponents\Format\Yaml\Yaml as YamlFormat;

/**
 * CalliopeFrameworkExtension 
 * 
 * @uses ClioBundleExtension
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class CalliopeFrameworkExtension extends Extension 
{
	private $loader;

	private $connections = array();

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        $this->loader = $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
		
		$this->loader->load('services.xml');
		$this->loader->load('metadata.xml');
		$this->loader->load('mapping.xml');
		$this->loader->load('manager.xml');
		$this->loader->load('connection.xml');

		// Load Default Settings
        //$loader->load('defaults.xml');


		// Overwrite Configurations

		// Map Service Aliases
		{
			// Map Component Services
			//$container->setAlias('calliope_framework.class_metadata_registry', $config['services']['class_metadata_registry'] ?: 'clio_framework.metadata.registry');
		}
	
		//$loader->load('services.xml');
		//$loader->load('filters.xml');


		$this->registerFilterListenerFactories($container, $config['listener_factories']);
		// Register Schema Managers
		$this->registerSchemas($container, $config['schemas'], isset($config['autoload']) ? true : $config['bundles'] );

		//$this->registerDoctrineEventListeners($container, $config['schemas']);

		//$this->registerJMSSerializer($container, $config['jms_serializer']);
    }

	/**
	 * registerSchemas 
	 *
	 * @param mixed $container 
	 * @param array $schemas 
	 * @param bool|array $bundles true as autoload, array as set of bundles to load. otherwise do not load bundle configuration.
	 * @access protected
	 * @return void
	 */
	protected function registerSchemas($container, array $schemas, $bundles = true)
	{
		// Load configurations under Bundles
		{
			$importedSchemas = array();
			// AutoLoad Bundle related schemas
			if($bundles) {
				$dirs = $this->getBundleConfigDir($container->getParameter('kernel.bundles'));
				foreach($dirs as $bundleName => $dir) {
					$bundleNameSnakeCase = ClioUtil\Grammer\Grammer::snakize($bundleName);
					$loader  = new ClioLoader\FormatFileLoader(new ClioUtil\Locator\FileLocator($dir), array(new YamlFormat()));
					try {
						$bundleConfigs = $loader->load('calliope.yml');
						if(!isset($bundleConfigs['schema'])) {
							continue;
						}
						$bundleSchemas = $bundleConfigs['schema'];
						
						foreach($bundleSchemas as $name => $schemaConfig) {
							$importedSchemas[$bundleNameSnakeCase . '.' . $name] = $schemaConfig; 
						}
					} catch(ResourceNotFoundException $ex) {
						// ignore exception
					}
				}
			} else if(is_array($bundles)) {
				$dirs = $this->getBundleConfigDir($container->getParameter('kernel.bundles'));
				foreach($dirs as $bundleName => $dir) {
					if(in_array($bundleName, $bundles)) {
						$bundleNameSnakeCase = ClioUtil\Grammer\Grammer::snakize($bundleName);
						$loader  = new ClioLoader\FormatFileLoader(new ClioUtil\Locator\FileLocator($dir), array(new YamlFormat()));

						$bundleConfigs = $loader->load('calliope.yml');
						if(!isset($bundleConfigs['schema'])) {
							continue;
						}
						$bundleSchemas = $bundleConfigs['schema'];
						
						foreach($bundleSchemas as $name => $schemaConfig) {
							$importedSchemas[$bundleNameSnakeCase . '.' . $name] = $schemaConfig; 
						}
					}
				}
				
			}

			// fixme: should be in loader
			array_walk($importedSchemas, function(&$v) {
				if(!isset($v['mappings']))
					$v['mappings'] = array();

				if(!isset($v['manager_class'])) 
					$v['manager_class'] = null;
				if(!isset($v['options']))
					$v['options'] = array();
			});

			$schemas = array_merge($importedSchemas, $schemas);
		}
		


		$registry = $container->getDefinition('calliope_framework.metadata.registry');
		foreach($schemas as $name => $params) {
			if('alias' == $params['type']) {
				// Aliasing to the service.
				$registry->addMethodCall('setAlias', array($name, $params['connect_to']));
			} else {
				$configs = array();

				// set mapping configuration
				$configs['mappings'] = $params['mappings']; 

				// set strict configuratins
				$configs['class'] = $params['class'];


				$dispatcherId       = $this->createConnectionEventDispatcher($container, $name);
				// Create Connection for the manager
				$connectionId = $this->createConnection($container, $name, $params['type'], $params['connect_to'], isset($params['options']['connection']) ? $params['options']['connection'] : array());

				// Create Connection Filters
				$this->createConnectionFilters($container, $name, array('event_dispatcher' => new Reference($dispatcherId)));


				// append FilterListeners on EventDispatcherFilter
				if(isset($params['listeners']) && !empty($params['listeners'])) {
					foreach($params['listeners'] as $listenerName => $listenerOptions) {
						$listenerId = $this->createConnectionFilterListener($container, $name, $listenerName, $dispatcherId, $listenerOptions);
					}
				}

				$configs['mappings']['schema_manager'] = array(
					'manager_class'   => $params['manager_class'],
					'connection'      => $connectionId,
					'options'         => $params['options'], 
				);

				$registry->addMethodCall('set', array($name, $configs));
			}
		}
	}

	protected function createConnectionFilterListener($container, $schemaName, $listenerName, $dispatcherId, array $listenerOptions = array())
	{
		$connectionFilterListener = new DefinitionDecorator('calliope_framework.default_filter_listener');
		$connectionFilterListener->replaceArgument(0, $listenerName);
		$connectionFilterListener->replaceArgument(1, $listenerOptions);

		$connectionFilterListener->addTag('calliope_framework.filter_listener', array('dispatcher' => $dispatcherId));

		$container->setDefinition(
			'calliope_framework.filter_listener_on_' . $schemaName. '.filter_listener_' . $listenerName,
			$connectionFilterListener
		);
	}

	protected function createConnection($container, $name, $type, $connectTo, array $options)
	{
		$connectionId       = $this->createConnectionRaw($container, $name, $type, $connectTo, $options);

		// Create Listeners

		$filterConnectionId = 'calliope_framework.connection.' . $name;

		// Create Filter Connection with Raw Connection and Filter
		$filterConnection = new DefinitionDecorator('calliope_framework.filter_connection._default');
		$filterConnection->replaceArgument(0, new Reference($connectionId));
		$filterConnection->replaceArgument(1, new Reference($filterConnectionId . '.filters', ContainerInterface::NULL_ON_INVALID_REFERENCE));
		$container->setDefinition($filterConnectionId, $filterConnection);

		return $filterConnectionId;
	}

	protected function createConnectionRaw($container, $name, $type, $connectTo, array $options)
	{
		$id = 'calliope_framework.connection_raw.' . $name;
		$definition = new DefinitionDecorator('calliope_framework.connection._default');
		$definition->replaceArgument(0, $type);
		$definition->replaceArgument(1, $connectTo);
		$definition->replaceArgument(2, $options);
		$container->setDefinition($id, $definition);

		return $id;
	}

	protected function createConnectionEventDispatcher($container, $name)
	{
		$id = 'calliope_framework.connection_' . $name . '.event_dispatcher';

		$definition = new DefinitionDecorator('calliope_framework.event_dispatcher._default');
		$container->setDefinition($id, $definition);

		return $id;
	}

	protected function createConnectionFilters($container, $schemaName, array $options = array())
	{
		// Create Filters
		$filterDefinition = new DefinitionDecorator('calliope_framework.default_filter');
		$filterDefinition->replaceArgument(0, $options);
		$container->setDefinition('calliope_framework.connection.' . $schemaName . '.filters', $filterDefinition);
	}

	/**
	 * registerFilterListenerFactories 
	 *   
	 * @param mixed $container 
	 * @param array $filters 
	 * @access protected
	 * @return void
	 */
	protected function registerFilterListenerFactories($container, array $filters)
	{
		$this->getLoader()->load('filters.xml');
		foreach($filters as $name => $params) {
			// FactoryFactory might be a better design
			// Get listenerFactory prototype
			$definition = new DefinitionDecorator('calliope_framework.default_filter_listener_factory');

			$params['options']['priority'] = $params['priority'];
			//
			$definition->replaceArgument(0, $params['class']);
			$definition->replaceArgument(1, $params['options']);

			$definition->addTag('calliope_framework.filter_listener_factory', array('for' => $name));
			
			// Set Defintion
			$container->setDefinition(
				'calliope_framework.filter_listener_factory.' . $name,
				$definition
			);
		}
	}

	/**
	 * registerDoctrineEventListeners 
	 * 
	 * @param mixed $container 
	 * @param array $schemas 
	 * @access protected
	 * @return void
	 */
	protected function registerDoctrineEventListeners($container, array $schemas)
	{
		foreach($schemas as $name => $schema) {
			if('doctrine.orm' === $schema['type']) {
				// 
				$definition = new DefinitionDecorator('calliope_framework.doctrine_orm_event_listener.schema_persist_event.default');

				$definition
					->replaceArgument(0, new Reference('calliope_framework.schemas.' . $name))
					->addTag(
						'doctrine.event_listener',
						array(
							'event' => 'prePersist',
							'lazy' => true
						)
					)
				;

				$container->setDefinition(
					'calliope_framework.doctrine_orm_event_listener.schema_persist_event.' . $name,
					$definition
				);
			}
		}
	}

	protected function getLoader()
	{
		return $this->loader;
	}

	/**
	 * getBundleConfigDir 
	 *   Get all bundles' config_dir pass to the config file locator.
	 * @param array $bundles 
	 * @access protected
	 * @return void
	 */
	protected function getBundleConfigDir(array $bundles)
	{
        $directories = array();
        foreach ($bundles as $name => $class) {
            $ref = new \ReflectionClass($class);
            $directories[$name] = dirname($ref->getFileName()).'/Resources/config/';
        }

		return $directories;
	}

	/**
	 * getNamespacedName 
	 * 
	 * @param mixed $name 
	 * @access protected
	 * @return void
	 */
	protected function getNamespacedName($name)
	{
		return $this->getAlias() . '.' . $name;
	}
}
