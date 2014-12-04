<?php

namespace Calliope\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;


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


		//$this->registerFilters($container, $config['filters']);
		// Register Schema Managers
		$this->registerSchemas($container, $config['schemas']);

		//$this->registerDoctrineEventListeners($container, $config['schemas']);

		//$this->registerJMSSerializer($container, $config['jms_serializer']);
    }

	/**
	 * registerSchemas 
	 * 
	 * @param mixed $container 
	 * @param array $schemas 
	 * @access protected
	 * @return void
	 */
	protected function registerSchemas($container, array $schemas)
	{

		$registry = $container->getDefinition('calliope_framework.metadata.registry');
		foreach($schemas as $name => $params) {

			$configs = array();

			// set mapping configuration
			$configs['mappings'] = $params['mappings']; 

			// set strict configuratins
			$configs['class'] = $params['class'];

			// Create Connection for the manager
			$connectionId = $this->createConnection($container, $name, $params['type'], $params['connect_to'], isset($params['options']['connection']) ? $params['options']['connection'] : array());

			$configs['mappings']['schema_manager'] = array(
				'manager_class'   => $params['manager_class'],
				'connection'      => $connectionId,
				'filters'         => $params['filters'], 
				'options'         => $params['options'], 
			);

			$registry->addMethodCall('set', array($name, $configs));
		}
	}

	protected function createConnection($container, $name, $type, $connectTo, array $options)
	{
		$id = 'calliope_framework.connection.' . $name;
		// get prototype definition
		$connection = new DefinitionDecorator('calliope_framework.default_connection');

		$connection->replaceArgument(0, $type);
		$connection->replaceArgument(1, $connectTo);
		$connection->replaceArgument(2, $options);

		$container->setDefinition($id, $connection);

		return $id;
	}

	protected function registerFilters($container, array $filters)
	{
		foreach($filters as $name => $params) {
			$definition = new DefinitionDecorator('calliope_framework.filter.default');

			$definition
				->replaceArgument(0, $params['type'])
				->replaceArgument(1, $params['options'])
			;
			
			$definition->addTag('calliope_framework.filter', array('for' => $name));
			
			// Set Defintion
			$container->setDefinition(
				'calliope_framework.filters.' . $name,
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
            $directories[$ref->getNamespaceName()] = dirname($ref->getFileName()).'/Resources/config/';
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
