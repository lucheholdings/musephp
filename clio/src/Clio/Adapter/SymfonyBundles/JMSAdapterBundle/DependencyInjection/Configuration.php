<?php

namespace Clio\Adapter\SymfonyBundles\JMSAdapterBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('clio_jms_adapter');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

		$rootNode
			->children()
				->append($this->buildSerializerSection())
			->end()
		;

        return $treeBuilder;
    }

	protected function buildSerializerSection()
	{
		$treeBuilder = new TreeBuilder();
		$node = $treeBuilder->root('serializer');

		$node
			->canBeEnabled()
			->addDefaultsIfNotSet()
			->children()
				->arrayNode('handlers')
					->addDefaultsIfNotSet()
					->children()
						->booleanNode('attribute_container')->defaultTrue()->end()
						->booleanNode('attribute')->defaultFalse()->end()
						->booleanNode('tag')->defaultFalse()->end()
						// For Doctrine Adatpters
						->booleanNode('doctrine_proxy_collection')->defaultTrue()->end()
						->booleanNode('doctrine_attribute_collection')->defaultTrue()->end()
						->booleanNode('doctrine_tag_collection')->defaultTrue()->end()
						->booleanNode('doctrine_reference')->defaultTrue()->end()
						->booleanNode('doctrine_id_reference')->defaultTrue()->end()
						->booleanNode('doctrine_reference_collection')->defaultTrue()->end()
						->booleanNode('doctrine_id_reference_collection')->defaultTrue()->end()
					->end()
				->end()
				->arrayNode('listeners')
					->addDefaultsIfNotSet()
					->children()
						->booleanNode('attribute_container_aware')->defaultTrue()->end()
						->booleanNode('doctrine_reference')->defaultTrue()->end()
					->end()
				->end()
			->end()
		;

		return $node;
	}
}
