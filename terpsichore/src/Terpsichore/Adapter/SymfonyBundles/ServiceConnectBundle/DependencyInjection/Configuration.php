<?php

namespace Terpsichore\Adapter\SymfonyBundles\ServiceConnectBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('terpsichore_service_connect');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

		$rootNode
			->children()
				->append($this->buildServiceSection())
			->end()
		;

        return $treeBuilder;
    }

	protected function buildServiceSection()
	{
		$treeBuilder = new TreeBuilder();
		$node = $treeBuilder->root('services');

		$node
			->example(array('facebook' => array('type' => 'facebook', 'auth' => array('type' => 'oauth2.authorization_code', 'id' => 'yourClientId', 'secret' => 'YourClientSecret'))))
			->useAttributeAsKey('name')
			->prototype('array')
				->children()
					->scalarNode('type')->defaultFalse()->info('Type of service. If false, use name as a type')->end()
					->arrayNode('auth')
						->canBeEnabled()
						->children()
							->scalarNode('type')->defaultFalse()->end()
							->scalarNode('id')->defaultNull()->example('username')->end()
							->scalarNode('secret')->defaultNull()->example('password')->end()
							->arrayNode('options')
								->prototype('variable')->end()
							->end()
						->end()
					->end()
				->end()
			->end()
		;

		return $node;
	}
}
