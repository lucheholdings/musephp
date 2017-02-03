<?php

namespace Clio\Adapter\SymfonyBundles\OAuth2ClientBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Loader,
	Symfony\Component\DependencyInjection\Definition,
	Symfony\Component\DependencyInjection\Reference
;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ClioOAuth2ClientExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
        $loader->load('security.xml');

		//if(isset($config['user_provider'])) {
		//	$this->registerUserProvider($container, $config['user_provider']['type'], $config['user_provider']['class'], $config['user_provider']['params']);
		//}

    }

	protected function registerUserProvider(ContainerBuilder $container, $type, $class = null, $params = array())
	{
		$cleanedParams = array();
		switch($type) {
		case 'proxy':
			if(!$class) {
				$class = '%clio.auth.client.user_provider.proxy.class%';	
			}
			
			$cleanedParams[] = new Reference($params['provider']);
			break;
		default:
			throw new \InvalidArgumentException('Invalid type is given.');
		}

		$container->setDefinition(
			'clio.auth.client.user_provider',
			new Definition($class, $cleanedParams)
		);
	}

	protected function registerProfileProvider($container, $configs)
	{
		if(isset($configs['id'])) {
			$container->setAlias('clio.auth.client.profile_provider', $configs['id']);
		}
	}

	/**
	 * getAlias 
	 * 
	 * @access public
	 * @return void
	 */
	public function getAlias()
	{
		return 'clio_oauth2_client';
	}
}
