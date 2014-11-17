<?php

namespace Erato\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('erato_framework');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

		$rootNode
			->addDefaultsIfNotSet()
			->children()
				->append($this->buildCacheSection())
				->append($this->buildCodingSection())
				->arrayNode('mappings')
					->addDefaultsIfNotSet()
					->useAttributeAsKey('name')
					->children()
						->append($this->buildAccessorMappingSection())
						->append($this->buildNormalizerMappingSection())
						//->append($this->buildSerializerMappingSection())
						//->append($this->buildSchemifierMappingSection())
					->end()
				->end()
			->end()
		;

        return $treeBuilder;
    }

	/**
	 * buildCodingSection 
	 *  
	 * coding_standards:
	 *     naming:
	 *         class:           pascal
	 *         property:        camel
	 *         array_field:     snake
	 * 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function buildCodingSection()
	{
		$treeBuilder = new TreeBuilder();
		$node = $treeBuilder->root('coding_standard');

		$node
			->children()
				->arrayNode('naming')
					->children()
						->scalarNode('class')->defaultValue('pascal')->end()
						->scalarNode('property')->defaultValue('camel')->end()
						->scalarNode('array_field')->defaultValue('snake')->end()
					->end()
				->end()
			->end()
		;

		return $node;
	}

	protected function buildCacheSection()
	{
		$treeBuilder = new TreeBuilder();
		$node = $treeBuilder->root('cache');

		$node
			->canBeDisabled()
			->addDefaultsIfNotSet()
			->beforeNormalization()
				->ifString()
				->then(function($v){
					return array('type' => 'alias', 'id' => $v);	
				})
			->end()
			->children()
				->scalarNode('type')->defaultValue('filesystem')->end()
				->scalarNode('id')->end()
				->arrayNode('options')
					->defaultValue(array('directory' => '%kernel.cache_dir%/clio_metadata', 'extension' => '.cache.php'))
					->prototype('variable')
					->end()
				->end()
			->end()
		;

		return $node;
	}

	protected function buildSerializerMappingSection()
	{
		$treeBuilder = new TreeBuilder();
		$node = $treeBuilder->root('serializer');

		$node
			->canBeDisabled()
			->addDefaultsIfNotSet()
			->children()
				->scalarNode('default_serailzier')->defaultValue('erato_framework.serializer')->end('erato_framework')
			->end()
		;

		return $node;
	}

	protected function buildAccessorMappingSection()
	{
		$treeBuilder = new TreeBuilder();
		$node = $treeBuilder->root('accessor');

		$node
			->canBeDisabled()
			->addDefaultsIfNotSet()
		;

		return $node;
	}

	protected function buildSchemifierMappingSection()
	{
		$treeBuilder = new TreeBuilder();
		$node = $treeBuilder->root('schemifier');

		$node
			->canBeDisabled()
			->addDefaultsIfNotSet()
			->children()
				->scalarNode('defualt_schemifier')->defaultValue('erato_framework.schemifier')->end()
			->end()
		;

		return $node;
	}

	/**
	 * buildNormalizerMappingSection 
	 * 
	 * normalizer:
	 *     enabled:              true 
	 *     default_normalizer:   normalizer.service_id
	 * 
	 * @access protected
	 * @return void
	 */
	protected function buildNormalizerMappingSection()
	{
		$treeBuilder = new TreeBuilder();
		$node = $treeBuilder->root('normalizer');

		$node
			->canBeDisabled()
			->addDefaultsIfNotSet()
			->children()
				// Additional Strategy 
				->scalarNode('default_normalizer')->defaultValue('clio_component.normalizer')->end()
			->end()
		;

		return $node;
	}
}
