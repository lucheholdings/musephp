<?php
namespace Terpsichore\Bundle\OAuth2ServerBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Definition;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class TerpsichoreOAuth2ServerExtension extends Extension
{
	private $loader;

	/**
	 * getAlias 
	 * 
	 * @access public
	 * @return void
	 */
	public function getAlias()
	{
		return 'terpsichore_oauth2_server';
	}

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration($container->get('kernel.debug'));
        $config = $this->processConfiguration($configuration, $configs);

        $this->loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
		
		if($config['token_provider']['enabled']) {
			$this->configureTokenProvider($container, $config['token_provider']);
		}

		if($config['security']['enabled']) {
			$this->configureSecurity($container, $config['security']);
		}
	}

	protected function configureTokenProvider(ContainerBuilder $container, array $configs)
	{

		$this->configureStorages($container, $configs['storages']);

		$this->configureResponseTypes($container, $configs['response_types']);
		$this->configureGrantTypes($container, $configs['grant_types']);

		$this->loader->load('oauth2.xml');
		$this->loader->load('controller.xml');

		$this->configureServerConfig($container, $configs['server']);
		$container->setParameter('terpsichore_oauth2_server.supported_scopes', $configs['supported_scopes']);
		$container->setParameter('terpsichore_oauth2_server.default_scopes', $configs['default_scopes']);
	}

	protected function configureServerConfig(ContainerBuilder $container, array $configs)
	{
		$container->setParameter('terpsichore_oauth2_server.server.config', $configs);
	}

	protected function configureStorages(ContainerBuilder $container, array $configs)
	{
		// Load Default Service Definitions
		$this->loader->load('storage_strategies.xml');
		$this->loader->load('doctrine_cache.xml');
		$this->loader->load('doctrine_orm.xml');
		$this->loader->load('storages.xml');

		foreach($configs as $name => $storageConfig) {
			if($storageConfig['enabled']) {
				$options = $storageConfig['options'];
				if(isset($storageConfig['class'])) {
					$options['class'] = $storageConfig['class'];
				}

				// Construct StorageStrategy
				if(isset($storageConfig['use_strategy'])) {

					$definition = new DefinitionDecorator('terpsichore_oauth2_server.storage_strategy.' . $name . '.default');

					// Replace ConstructorArgument
					$definition->replaceArgument(0, $storageConfig['type']);
					$definition->replaceArgument(1, $storageConfig['connect_to']);
					$definition->replaceArgument(2, $options);

					$container->setDefinition(
						'terpsichore_oauth2_server.storage_strategy.' . $name,
						$definition
					);
				}

				// Update Storage Construction Parameters if its needed
				$storageOptions = array();
				if(isset($storageConfig['storage_class'])) {
					$storageOptions['class'] = $storageConfig['storage_class'];
				}

				$storageDefinition = new DefinitionDecorator('terpsichore_oauth2_server.storage.' . $name . '.default');
				$storageDefinition->replaceArgument(2, $storageOptions);

				$storageDefinition->addTag('terpsichore_oauth2_server.storage', array('for' => $name));
				$container->setDefinition(
					'terpsichore_oauth2_server.storage.' . $name,
					$storageDefinition
				);	
			}
		}
	}

	protected function configureResponseTypes(ContainerBuilder $container, array $configs)
	{
		$this->loader->load('response_types.xml');

		foreach($configs as $name => $service) {
			if($service) {
				$definition = new DefinitionDecorator($service);
				$definition->addTag('terpsichore_oauth2_server.response_type', array('for' => $name));

				$container->setDefinition('terpsichore_oauth2_server.response_type.' . $name, $definition);
			}
		}
	}

	protected function configureGrantTypes(ContainerBuilder $container, array $configs)
	{
		// Load GrantTypes definition
		$this->loader->load('grant_types.xml');
	}
	
	/**
	 * configureSecuity
	 * 
	 * @param ContainerBuilder $container 
	 * @param array $configs 
	 * @access protected
	 * @return void
	 */
	protected function configureSecurity(ContainerBuilder $container, array $configs)
	{
		$this->loader->load('security.xml');
		$this->loader->load('client.xml');

		if(isset($configs['token_resolver']) && isset($configs['token_resolver']['enabled'])) {
			$this->configureSecurityTokenResolver($container, $configs['token_resolver']);
		}

		$this->configureSecurityUserinfoProvider($container, $configs['userinfo_provider']);
		
	}

	protected function configureSecurityUserinfoProvider(ContainerBuilder $container, array $configs)
	{
		$definition = new DefinitionDecorator('terpsichore_oauth2_server.security.user_provider.default');
		
		$userinfoProviderId = null;
		if($configs['enabled']) {
			$userinfoProviderId = $this->configureUserinfoProvider($container, $configs);
		}

		$definition->replaceArgument(0, $userinfoProviderId ? new Reference($userinfoProviderId) : null);

		$container->setDefinition(
			'terpsichore_oauth2_server.security.user_provider',
			$definition
		);
	}

	protected function configureUserinfoProvider(ContainerBuilder $container, array $configs)
	{
		$id = 'terpsichore_oauth2_server.userinfo_provide_client';
		$definition = new DefinitionDecorator('terpsichore_oauth2_server.userinfo_provider_client.default');

		$definition
			->replaceArgument(0, $configs['base_url'])
			->replaceArgument(1, array(
				'userinfo_path'  => $configs['path'],
				'client_id'      => $configs['client_id'],
				'client_secret'  => $configs['client_secret'],
			))
			->replaceArgument(2, $configs['cache'] ? new Reference($configs['cache']) : null)
		;

		$container->setDefinition(
			$id,
			$definition
		);
		

		return $id;
	}

	protected function configureSecurityTokenResolver(ContainerBuilder $container, array $configs)
	{
		switch($configs['type']) {
		case 'server':
			$tokenProviderId = 'terpsichore_oauth2_server.server';
			break;
		case 'tokeninfo':
		case 'chain_grant':
			$tokenProviderId = $this->configureTokenProviderClient($container, $configs);
			break;
		}

		$resolver = new DefinitionDecorator('terpsichore_oauth2_server.token_resolver.default');

		$resolver
			->replaceArgument(0, $configs['type'])
			->replaceArgument(1, new Reference($tokenProviderId))
			->replaceArgument(2, isset($configs['cache']) ? new Reference($configs['cache']) : null)
		;

		$container->setDefinition(
			'terpsichore_oauth2_server.token_resolver',
			$resolver
		);
	}

	protected function configureTokenProviderClient(ContainerBuilder $container, array $configs)
	{
		$id = 'terpsichore_oauth2_server.token_provide_client';
		$definition = new DefinitionDecorator('terpsichore_oauth2_server.token_provider_client.default');

		$definition
			->replaceArgument(0, $configs['base_url'])
			->replaceArgument(1, array(
				'token_path'     => $configs['token_path'],
				'tokeninfo_path' => $configs['tokeninfo_path'],
				'client_id'      => $configs['client_id'],
				'client_secret'  => $configs['client_secret'],
			))
		;

		$container->setDefinition(
			$id,
			$definition
		);

		return $id;
	}
}
