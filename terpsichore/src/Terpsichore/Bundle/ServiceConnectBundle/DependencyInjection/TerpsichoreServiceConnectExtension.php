<?php

namespace Terpsichore\Bundle\ServiceConnectBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class TerpsichoreServiceConnectExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

		$loader->load('hwi_oauth.xml');
		$loader->load('hwi_buzz.xml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // setup buzz client settings
        $httpClient = $container->getDefinition('hwi_buzz.client');
        $httpClient->addMethodCall('setVerifyPeer', array($config['hwi']['http_client']['verify_peer']));
        $httpClient->addMethodCall('setTimeout', array($config['hwi']['http_client']['timeout']));
        $httpClient->addMethodCall('setMaxRedirects', array($config['hwi']['http_client']['max_redirects']));
        $httpClient->addMethodCall('setIgnoreErrors', array($config['hwi']['http_client']['ignore_errors']));
        $container->setDefinition('terpsichore_service_connect.hwi_http_client', $httpClient);

        // setup services for all configured resource owners
        $resourceOwners = array();
        foreach ($config['hwi']['resource_owners'] as $name => $options) {
            $resourceOwners[] = $name;
            $this->createResourceOwnerService($container, $name, $options);
        }
        $container->setParameter('terpsichore_service_connect.hwi_resource_owners', $resourceOwners);
    }

    /**
     * Creates a resource owner service.
     *
     * @param ContainerBuilder $container The container builder
     * @param string           $name      The name of the service
     * @param array            $options   Additional options of the service
     */
    public function createResourceOwnerService(ContainerBuilder $container, $name, array $options)
    {
        // alias services
        if (isset($options['service'])) {
            // set the appropriate name for aliased services, compiler pass depends on it
            $container->setAlias('terpsichore_service_connect.hwi_resource_owner.'.$name, $options['service']);
        } else {
            $type = $options['type'];
            unset($options['type']);

            $definition = new DefinitionDecorator('terpsichore_service_connect.hwi_abstract_resource_owner.'.Configuration::getHWIResourceOwnerType($type));
            $definition->setClass("%terpsichore_service_connect.hwi_resource_owner.$type.class%");
            $container->setDefinition('terpsichore_service_connect.hwi_resource_owner.'.$name, $definition);
            $definition
                ->replaceArgument(2, $options)
                ->replaceArgument(3, $name)
            ;
        }
    }

	public function getAlias()
	{
		return 'terpsichore_service_connect';
	}
}
