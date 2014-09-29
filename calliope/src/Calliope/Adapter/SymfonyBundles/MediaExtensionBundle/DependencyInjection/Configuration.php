<?php

namespace Calliope\Adapter\SymfonyBundles\MediaExtensionBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('calliope_media_extension');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

		$rootNode
			->children()
				->append($this->buildMediaSection())
			->end()
		;

        return $treeBuilder;
    }

	public function buildMediaSection()
	{
		$tree = new TreeBuilder();
		$node = $tree->root('media');

		$node
			->defaultValue(array())
			->treatNullLike(array())
			->useAttributeAsKey('name')
			->prototype('array')
				->children()
					->scalarNode('type')->defaultValue('path')->end()
					->arrayNode('params')
						->useAttributeAsKey('key')
						->treatNullLike(array())
						->prototype('variable')->end()
				->end()
			->end()
		;

		return $node;
	}
}
