<?php

namespace Calliope\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Clio\Symfony\Component\Config\Definition\ClioBundleConfiguration;

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
        $rootNode = $treeBuilder->root('calliope_framework');

        // Here you should define the parameters that are allowed to
        // build your bundle. See the documentation linked above for
        // more information on that topic.
		$rootNode
			->children()
				//->append($this->buildServiceMappingSection())
				//->append($this->buildFilterSection())
				//->append($this->buildManagerSection())
				->append($this->buildSchemaSection())
			->end()
		;

        return $treeBuilder;
    }

	protected function buildSchemaSection()
	{
		$tree = new TreeBuilder();

		$node = $tree->root('schemas');

		$node
			->useAttributeAsKey('name')
			->info('Schema definitions')
			->prototype('array')
				->children()
					->scalarNode('class')->cannotBeEmpty()->info('Target class path')->end()
					->scalarNode('manager_class')->defaultNull()->info('SchemaManager classpath')->end()
					->scalarNode('type')->cannotBeEmpty()->info('Connection Type')->end()
					->scalarNode('connect_to')->cannotBeEmpty()->end()
					->arrayNode('filters')
						->info('List of filter service ids')
						->example(array('service.filter_01', 'filter_02'))
						->defaultValue(array())
						->prototype('scalar')->end()
					->end()
					->arrayNode('options')
						->info('SchemaManager options')
						->useAttributeAsKey('key')
						->treatNullLike(array())
						->prototype('variable')->end()
					->end()
					->arrayNode('mappings')
						->info('Schema Mapping Options - with this options, you can overwite static schema mapping')
						->example(array('normalizer' => array('normalizer' => 'normalizer.service_id')))
						->useAttributeAsKey('key')
						->treatNullLike(array())
						->prototype('variable')->end()
					->end()
				->end()
			->end()
		;
		
		return $node;
	}

	protected function buildFilterSection()
	{
		$tree = new TreeBuilder();

		$node = $tree->root('filters');

		$node
			->useAttributeAsKey('name')
			->prototype('array')
			->beforeNormalization()
				->ifString()
				->then(function($v){ return array('type' => 'service', 'options' => array('id' => $v));})
			->end()
			->children()
				->scalarNode('type')->cannotBeEmpty()->end()
				->arrayNode('options')
					->useAttributeAsKey('key')
					->treatNullLike(array())
					->defaultValue(array())
					->prototype('variable')->end()
				->end()
			->end()
		;
		
		return $node;
	}

	/**
	 * buildJMSSerializerSection 
	 * 
	 * @param array $handlers 
	 * @param array $listeners 
	 * @access protected
	 * @return void
	 */
	protected function buildJMSSerializerSection(array $handlers, array $listeners)
	{
		$treeBuilder = new TreeBuilder();
		$node = $treeBuilder->root('jms_serializer');

		$node
			->canBeEnabled()
		;

		if(!empty($handlers)) {
			$handlerNode = $node->children()->arrayNode('handlers')
				->addDefaultsIfNotSet()
			;
			foreach($handlers as $handler) {
				$handlerNode->children()->booleanNode($handler)->defaultTrue()->end();
			}
		}

		if(!empty($listeners)) {
			$listenerNode = $node->children()->arrayNode('listeners')
				->addDefaultsIfNotSet()
			;
			foreach($listeners as $listener) {
				$listenerNode->children()->booleanNode($listener)->defaultTrue()->end();
			}
		}

		return $node;
	}
}
