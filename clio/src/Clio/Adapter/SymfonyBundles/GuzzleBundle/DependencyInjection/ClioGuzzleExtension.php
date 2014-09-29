<?php

namespace Clio\Adapter\SymfonyBundles\GuzzleBundle\DependencyInjection;
// 
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
//
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ClioGuzzleExtension extends Extension
{
	protected $serviceDefaults = array();

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration($container->getParameter('kernel.debug'));
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

		$defaultConfiguration = array();
		// Default Configurations
		if(isset($config['description_file'])) {
			$defaultConfiguration['description_file'] = $config['description_file'];
		}
		
		foreach($config['auth_providers'] as $name => $authConfig) {
			$this->registerAuthProvider($container, $name, $authConfig);
		}

		//
		$this->initServiceDefaults($config);

		// Service Definitions
		foreach($config['clients'] as $name => $clientConfiguration) {
			$this->registerServiceClient($name, array_merge($defaultConfiguration, $clientConfiguration), $container);
		}
		
		//
        if ($config['logging']) {
            $container->findDefinition('guzzle.data_collector')
                ->addTag('data_collector', array('template' => 'ClioGuzzleBundle:Collector:guzzle', 'id' => 'guzzle'));
        }

		// 
    }

	protected function initServiceDefaults($configs)
	{
		if(isset($configs['default_cache_id']) && $configs['default_cache_id']) {
			$this->serviceDefaults['cache_id'] = $configs['default_cache_id'];
		}
	}

	protected function getServiceDefaults()
	{
		return $this->serviceDefaults;
	}

	protected function registerServiceClient($name, array $configs, $container)
	{
		$configs = array_merge($this->getServiceDefaults(), $configs);

		$clientClass      = $configs['client_class'];
		$params = $configs['params'];

		$client = new DefinitionDecorator('clio_guzzle.service.default');
		$client->setClass($clientClass);
		$client->setFactoryClass($clientClass);
		$client->addTag('guzzle.service');

		// Set Description file if needed
		if(isset($configs['description_file'])) {
			$description = new DefinitionDecorator('clio_guzzle.service_description.default');
			$description->replaceArgument(0, $configs['description_file']);
			// Set Description
			$container->setDefinition(
				'guzzle.service_description.' . $name,
				$description
			);
			// We have to build the description isntance from the filepath
			$client
				->addMethodCall('setDescription', array(new Reference('guzzle.service_description.' . $name)))
			;
		}
		
		//// CachePlugin
		//if(array_key_exists('cache_id', $serviceConfiguration) && $serviceConfiguration['cache_id']) {
		//	
		//	// Add Tag "guzzle.global_plugin" with type="cache" name="<cache_id>"
		//	$builderDefinition->addTag(
		//		'guzzle.global_plugin',
		//		array(
		//			'type' => 'cache',
		//			'name' => $serviceConfiguration['cache_id'],
		//		)
		//	);
		//}

		// Inject AuthenticationPlugin if needed.
		if(isset($configs['auth'])) {
			// 
			$this->injectAuthPlugin($client, $configs['auth']);
		}

		$this->injectLoggerPlugin($client);
		
		$client->replaceArgument(0, $params);
		$container
			->setDefinition(
				'guzzle.service.'.$name,
				$client
			)
		;
	}

	/**
	 * createCachePluginDefinition
	 * 
	 * @param mixed $serviceBuilder 
	 * @param mixed $configs 
	 * @access protected
	 * @return void
	 */
	protected function createCachePluginDefinition(ContainerBuilder $container, $id)
	{
		$adapterDefinition = null;
		if($id) {
			if(is_string($id) && $container->hasDefinition($id)) {
				$cacheServiceDefinition  = $container->findDefinition($id);
				$cacheReference = new Reference($id); 
			} else {
				// Not Implemented
				// $this->createCache
				throw new \Exception(sprintf('The specified cache "%s" is not found on Container.', $id));
			}
		}
		
		// Get Adapter class
		if($cacheServiceDefinition) {
			$refClass = new \ReflectionClass($cacheServiceDefinition->getClass());
			if($refClass->implementsInterface('\Doctrine\Common\Cache\Cache')) {
				$adapterClass = $container->getParameter('guzzle.cache.adapter.doctrine.class');
			} else {
				throw new \Exception('Currently only Doctrine Cache is supported.');
			}
		}

		return new Definition(
			$adapterClass,
			array($cacheReference)
		);
	}

	/**
	 * initLoggerPlugin 
	 * 
	 * @param Definition $serviceBuilder 
	 * @access protected
	 * @return void
	 */
	protected function injectLoggerPlugin(Definition $clientService) 
	{
		$clientService->addMethodCall('addSubscriber', array(new Reference('guzzle.plugin.log.array')));
		$clientService->addMethodCall('addSubscriber', array(new Reference('guzzle.plugin.log.monolog')));
	}


	protected function registerAuthProvider(ContainerBuilder $container, $name, array $configs = array())
	{
		$providerId = 'clio.guzzle.plugin.auth.'.$name;
		switch($configs['type']) {
		case 'oauth2':
			$providerDefinition = new Definition(
				'%clio.guzzle.plugin.oauth2.class%',
				array(
					isset($configs['default_token']) ? $configs['default_token']: null, 
					isset($configs['token_provider']) ? new Reference('guzzle.service.'.$configs['token_provider']): null, 
					array_merge($configs['options'], array(
						'client_id' => $configs['client_id'], 
						'client_secret' => $configs['client_secret']))
				)
			);
			$providerDefinition
				->setFactoryService('clio.guzzle.auth.builder.oauth2')
				->setFactoryMethod('build')
			;
			break;
		default:
			throw new \Exception('not supported.');
		}
	
		// 
		//
		$providerDefinition->addTag('clio.guzzle.authentication_provider', array('for' => $name));
		$container->setDefinition(
			$providerId,
			$providerDefinition
		);
	}

	protected function injectAuthPlugin(Definition $serviceClient, $providerId)
	{
		$providerId = 'clio.guzzle.plugin.auth.'.$providerId;
		$serviceClient->addMethodCall('addSubscriber', array(new Reference($providerId)));
	}
}
