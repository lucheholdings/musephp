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
		// Load Default Settings
        $loader->load('defaults.xml');

		// Overwrite Configurations

		// Map Service Aliases
		{
			// Map Component Services
			$container->setAlias('calliope_framework.class_metadata_registry', $config['services']['class_metadata_registry'] ?: 'clio_framework.class_metadata_registry');
		}
	
		$loader->load('services.xml');
		$loader->load('filters.xml');


		$this->registerFilters($container, $config['filters']);
		// Register Scheme Managers
		$this->registerSchemes($container, $config['schemes']);

		//$this->registerDoctrineEventListeners($container, $config['schemes']);

		//$this->registerJMSSerializer($container, $config['jms_serializer']);
    }

	/**
	 * registerSchemes 
	 * 
	 * @param mixed $container 
	 * @param array $schemes 
	 * @access protected
	 * @return void
	 */
	protected function registerSchemes($container, array $schemes)
	{
		foreach($schemes as $name => $params) {
			if(isset($params['manager_class'])) {
				$params['options']['manager_class'] = $params['manager_class'];
			}

			$definition = new DefinitionDecorator('calliope_framework.scheme_manager.default');
			$definition
				->replaceArgument(0, $params['class'])
				->replaceArgument(1, $params['type'])
				->replaceArgument(2, $params['connect_to'])
				->replaceArgument(3, $params['filters'])
				->replaceArgument(4, $params['options'])
			;
			
			// 
			//$definition->addTag('calliope_framework.scheme_manager', array('alias' => $name, 'for' => $params['class']));
			$definition->addTag('calliope_framework.scheme_manager', array('for' => $name));

			
			// Set Defintion
			$container->setDefinition(
				'calliope_framework.scheme_managers.' . $name,
				$definition
			);
		}
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
	 * @param array $schemes 
	 * @access protected
	 * @return void
	 */
	protected function registerDoctrineEventListeners($container, array $schemes)
	{
		foreach($schemes as $name => $scheme) {
			if('doctrine.orm' === $scheme['type']) {
				// 
				$definition = new DefinitionDecorator('calliope_framework.doctrine_orm_event_listener.scheme_persist_event.default');

				$definition
					->replaceArgument(0, new Reference('calliope_framework.schemes.' . $name))
					->addTag(
						'doctrine.event_listener',
						array(
							'event' => 'prePersist',
							'lazy' => true
						)
					)
				;

				$container->setDefinition(
					'calliope_framework.doctrine_orm_event_listener.scheme_persist_event.' . $name,
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
	 * registerJMSSerializer 
	 * 
	 * @param mixed $container 
	 * @param array $configs 
	 * @access protected
	 * @return void
	 */
	protected function registerJMSSerializer($container, array $configs)
	{
		// If "jms_serializer" is enabled, then configure for it.
		if(!empty($configs) && (isset($configs['enabled']) && $configs['enabled'])) {
			// Load 
			$this->getLoader()->load('jms_serializer.xml');

			// Activate Handlers
			if(isset($configs['handlers'])) {
				foreach($configs['handlers'] as $handler => $isEnabled) { 
					if($isEnabled) {
						// Create Definition from Default
						$definition = new DefinitionDecorator($this->getNamespacedName('jms_serializer.handler.'.$handler.'.default'));

						// Copy Tags
						$definition->setTags(
							$container->getDefinition($this->getNamespacedName('jms_serializer.handler.' . $handler . '.default'))->getTags()
						);

						$container->setDefinition(
							$this->getNamespacedName('jms_serializer.handler.'.$handler),
							$definition
						);
					}
				}
			}

			// Activate Listeners 
			if(isset($configs['listeners'])) {
				foreach($configs['listeners'] as $listener => $isEnabled) { 
					if($isEnabled) {
						// Create Definition from Default
						$definition = new DefinitionDecorator($this->getNamespacedName('jms_serializer.listener.'.$listener.'.default'));

						// Copy Tags
						$definition->setTags(
							$container->getDefinition($this->getNamespacedName('jms_serializer.listener.' . $listener . '.default'))->getTags()
						);

						$container->setDefinition(
							$this->getNamespacedName('jms_serializer.listener.'.$listener),
							$definition
						);
					}
				}
			}
		}
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
