<?php

namespace Clio\Adapter\SymfonyBundles\GuzzleBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
	private $debug;

	/**
	 * Constructor.
	 *
	 * @param Boolean $debug The kernel.debug value
	 */
	public function __construct($debug)
	{
		$this->debug = (Boolean) $debug;
	}
	/**
	 * {@inheritDoc}
	 */
	public function getConfigTreeBuilder()
	{
		$treeBuilder = new TreeBuilder();
		$rootNode = $treeBuilder->root('clio_guzzle');

		// Here you should define the parameters that are allowed to
		// configure your bundle. See the documentation linked above for
		// more information on that topic.
		$this->loadGuzzleServiceCloud($rootNode);

		return $treeBuilder;
	}

	protected function loadGuzzleServiceCloud($rootNode)
	{
		$rootNode
			->children()
				->scalarNode('logging')->defaultFalse()->end()
				->scalarNode('description_file')->defaultNull()->end()
				->scalarNode('default_cache_id')->defaultValue(false)->end()
				->scalarNode('default_builder_class')->defaultValue('Guzzle\Service\Builder\ServiceBuilder')->end()
				->scalarNode('default_serializer')->defaultValue('serializer')->end()
				->append($this->configureServiceMappings())
				->append($this->addAuthProviderNodes())
				->append($this->configureClients())
			->end()
		;
	}

	protected function addAuthProviderNodes()
	{
		$builder = new TreeBuilder();
		$node = $builder->root('auth_providers');

		$node
			->useAttributeAsKey('name')
				->prototype('array')
					->children()
						->scalarNode('type')->end()
						// OAuth2
						->scalarNode('client_id')->end()
						->scalarNode('client_secret')->end()
						->scalarNode('token_provider')->end()
						->arrayNode('options')
							->useATtributeAsKey('name')
							->prototype('variable')
						->end()
					->end()
				->end()
			->end()
		;

		return $node;
	}

	protected function configureClients()
	{
		$builder = new TreeBuilder();
		$node = $builder->root('clients');
		
		$node
			->useAttributeAsKey('name')
			->prototype('array')
				->children()
					->scalarNode('client_class')->defaultNull()->end()
					->scalarNode('description_file')->defaultNull()->end()
					->scalarNode('cache_id')->end()
					->scalarNode('auth')->end()
					->arrayNode('params')
						->useAttributeAsKey('name')
						->prototype('variable')
					->end()
				->end()
			->end()
		;
		return $node;
	}

	protected function configureServiceMappings()
	{
		$builder = new TreeBuilder();
		$root = $builder->root('services');

		$root
			->children()
				->scalarNode('serializer')->defaultValue('clio_component.serializer')->end()
			->end()
		;

		return $root;
	}
}
