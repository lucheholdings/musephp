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
				->append($this->buildCacheSection())
				->append($this->buildAccessorSection())
				->append($this->buildMetadataSection())
				//->append($this->buildSerializerSection())
				//->append($this->buildSchemifierSection())
				->append($this->buildNormalizerSection())
				//->append($this->buildCounterSection())
				//->append($this->buildKvsSection())
				//// Advanced 
				//->append($this->buildJMSSerializerSection(array('hash', 'hash_collection', 'key_value', 'key_value_collection', 'tag_collection'), array()))
			->end()
		;

        return $treeBuilder;
    }

	protected function buildCacheSection()
	{
		$treeBuilder = new TreeBuilder();
		$node = $treeBuilder->root('cache');

		$node
			->canBeDisabled()
			->addDefaultsIfNotSet()
			->children()
			->end()
		;

		return $node;
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

	protected function buildAccessorSection()
	{
		$treeBuilder = new TreeBuilder();
		$node = $treeBuilder->root('accessor');

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

	protected function buildMetadataSection()
	{
		$treeBuilder = new TreeBuilder();
		$node = $treeBuilder->root('metadata');

		$node
			->canBeDisabled()
			->addDefaultsIfNotSet()
			->children()
				->arrayNode('cache')
					->canBeDisabled()
					->beforeNormalization()
						->ifString()
						->then(function($v){
							return array('type' => 'alias', 'id' => $v);	
						})
					->end()
					->addDefaultsIfNotSet()
					->children()
						->scalarNode('type')->defaultValue('filesystem')->end()
						->scalarNode('id')->end()
						->arrayNode('options')
							->defaultValue(array('directory' => '%kernel.cache_dir%/clio_metadata', 'extension' => '.cache.php'))
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
	 * buildNormalizerSection 
	 * 
	 * 
	 * normalizer:
	 *     strategies:
	 *         datetime:
	 *             id:           ~
	 *             priority:     ~
	 *             options:
	 *                 format:   Y-m-d H:i:s
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
				// Additional Strategy 
				->arrayNode('strategies')
					->useAttributeAsKey('name')
					->prototype('array')
						->beforeNormalization()
							->ifString()
							->then(function($v){
								return array('id' => $v, 'priority' => null, 'options' => array());		
							})
						->end()
						->children()
							->scalarNode('id')->defaultNull()->end()
							->scalarNode('priority')->defaultNull()->end()
							->arrayNode('options')
								->defaultValue(array())
								->useAttributeAsKey('key')
								->prototype('variable')->end()
							->end()
						->end()
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
}
