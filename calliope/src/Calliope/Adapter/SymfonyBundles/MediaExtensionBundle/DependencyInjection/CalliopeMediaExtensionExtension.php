<?php

namespace Calliope\Adapter\SymfonyBundles\MediaExtensionBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

use Symfony\Component\DependencyInjection\DefinitionDecorator;
/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class CalliopeMediaExtensionExtension extends Extension
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

		$this->registerMedia($container, $config['media']);
    }

	/**
	 * registerMedia 
	 * 
	 * @param ContainerBuilder $container 
	 * @param array $configs 
	 * @access public
	 * @return void
	 */
	public function registerMedia(ContainerBuilder $container, array $configs)
	{
		foreach($configs as $name=> $mediaConfigs) {
			$definition = new DefinitionDecorator('calliope_media_extension.media.default');

			$definition
				->replaceArgument(0, $mediaConfigs['type'])
				->replaceArgument(1, $name)
				->replaceArgument(2, $mediaConfigs['params'])
			;

			$definition->addTag('calliope_media_extension.media');

			$container->setDefinition(
				'calliope_media_extension.media.' . $name,
				$definition
			);
		}
	}
}
