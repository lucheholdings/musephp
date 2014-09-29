<?php

namespace Clio\Adapter\SymfonyBundles\OAuth2ClientBundle\DependencyInjection;

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
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('clio_oauth2_client');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
		$rootNode
			->children()
				#->arrayNode('user_provider')
				#	->children()
				#		->scalarNode('class')->end()
				#		->scalarNode('type')->end()
				#		->arrayNode('params')
				#			->useAttributeAsKey('name')
				#			->prototype('variable')->end()
				#		->end()
				#	->end()
				#->end()
			->end()
		;

        return $treeBuilder;
    }
}
