<?php

namespace Clio\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('clio_framework');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

		$rootNode
			->children()
				->append($this->buildClassMetadataSection())
				->append($this->buildFieldAccessorSection())
				->append($this->buildSerializerSection())
				->append($this->buildSchemifierSection())
				->append($this->buildNormalizerSection())
				->append($this->buildCounterSection())
				->append($this->buildKvsSection())
				// Advanced 
				->append($this->buildJMSSerializerSection(array('hash', 'hash_collection', 'key_value', 'key_value_collection', 'tag_collection'), array()))
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
				->scalarNode('strategy')->defaultValue('clio_framework.serializer_strategy.default')->end('clio_framework')
			->end()
		;

		return $node;
	}

	protected function buildFieldAccessorSection()
	{
		$treeBuilder = new TreeBuilder();
		$node = $treeBuilder->root('field_accessor');

		$node
			->canBeEnabled()
			->addDefaultsIfNotSet()
		;

		return $node;
	}

	protected function buildSchemifierSection()
	{
		$treeBuilder = new TreeBuilder();
		$node = $treeBuilder->root('schemifier');

		$node
			->treatFalseLike(array('enabled' => false))
			->addDefaultsIfNotSet()
			->children()
				->booleanNode('enabled')->defaultTrue()->end()
				->scalarNode('factory_id')->defaultValue('clio_framework.schemifier_factory.normalizer')->end()
			->end()
		;

		return $node;
	}

	protected function buildClassMetadataSection()
	{
		$treeBuilder = new TreeBuilder();
		$node = $treeBuilder->root('class_metadata');

		$node
			->canBeEnabled()
			->addDefaultsIfNotSet()
			->children()
				->scalarNode('factory_id')->defaultValue('clio_framework.class_metadata_factory.default')->end()
				->arrayNode('default_mapping_factories')
					->addDefaultsIfNotSet()
					->children()
						->booleanNode('field_accessor')->defaultTrue()->end()
						->booleanNode('schemifier')->defaultTrue()->end()

						->booleanNode('attribute')->defaultTrue()->end()
						->booleanNode('tag')->defaultTrue()->end()
					->end()
				->end()
			->end()
		;

		return $node;
	}

	/**
	 * buildNormalizerSection 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function buildNormalizerSection()
	{
		$treeBuilder = new TreeBuilder();
		$node = $treeBuilder->root('normalizer');

		$node
			->canBeEnabled()
			->addDefaultsIfNotSet()
			->children()
				->scalarNode('strategy')->defaultValue('clio_framework.normalizer_strategy.default')->end()
			->end()
		;

		return $node;
	}

	/**
	 * buildCounterSection
	 * 
	 * @access protected
	 * @return void
	 */
	protected function buildCounterSection()
	{
		$treeBuilder = new TreeBuilder();
		$node = $treeBuilder->root('counter');

		$node
			->canBeEnabled()
			->addDefaultsIfNotSet()
			->children()
				->scalarNode('registry')->defaultValue('clio_framework.counter_registry.default')->end()
				->arrayNode('services')
					->prototype('array')
						->beforeNormalization()
							->ifString()
							->then(function($v){ return array('id' => $v); })
						->end()
						->children()
							->scalarNode('type')->defaultValue('service')->end()
							->arrayNode('arguments')
								->useAttributeAsKey('key')
								->prototype('variable')
							->end()
						->end()
					->end()
				->end()
			->end()
		;

		return $node;
	}

	/**
	 * buildKvsSection
	 * 
	 * @access protected
	 * @return void
	 */
	protected function buildKvsSection()
	{
		$treeBuilder = new TreeBuilder();
		$node = $treeBuilder->root('kvs');

		$node
			->canBeEnabled()
			->addDefaultsIfNotSet()
			->children()
				->scalarNode('registry')->defaultValue('clio_framework.kvs_registry.default')->end()
				->arrayNode('services')
					->prototype('array')
						->beforeNormalization()
							->ifString()
							->then(function($v){ return array('id' => $v); })
						->end()
						->children()
							->scalarNode('type')->defaultValue('service')->end()
							->scalarNode('cache')->defaultValue('array')->end()
							->arrayNode('arguments')
								->prototype('scalar')->end()
							->end()
							->arrayNode('options')
								->useAttributeAsKey('key')
								->prototype('variable')->end()
							->end()
						->end()
					->end()
				->end()
			->end()
		;

		return $node;
	}

	protected function buildJMSSerializerSection()
	{
		$treeBuilder = new TreeBuilder();
		$node = $treeBuilder->root('jms_serializer');

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
