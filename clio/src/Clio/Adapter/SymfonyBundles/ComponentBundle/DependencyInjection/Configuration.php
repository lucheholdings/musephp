<?php

namespace Clio\Adapter\SymfonyBundles\ComponentBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('clio_component');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

		$rootNode
			->addDefaultsIfNotSet()
			->children()
				->append($this->buildNormalizerSection())
				->append($this->buildCacheSection())
			->end()
		;

        return $treeBuilder;
    }

	protected function buildCacheSection()
	{
		$treeBuilder = new TreeBuilder();
		$node = $treeBuilder->root('cache');

		$node
			->addDefaultsIfNotSet()
			->children()
				->scalarNode('default_cache_factory')->defaultValue('clio_component.cache.factory.doctrine')->end()
				->scalarNode('default_cache_provider_factory')->defaultValue('clio_component.cache.provider_factory.doctrine')->end()
			->end()
		;

		return $node;
	}

	protected function buildNormalizerSection()
	{
		$treeBuilder = new TreeBuilder();
		$node = $treeBuilder->root('normalizer');

		$node
			->canBeDisabled()
			->addDefaultsIfNotSet()
		;

		$strategyNodes = $node
			->children()
				->arrayNode('strategies')
				->addDefaultsIfNotSet()
				->children()
		;

		$defaultStrategies = array(
			'datetime'      => array('enabled' => true, 'priority' => 0),
			'reference'     => array('enabled' => true, 'priority' => 0),
			'std_class'     => array('enabled' => true, 'priority' => 0),
			'array_access'  => array('enabled' => false, 'priority' => 0),
			'scalar'        => array('enabled' => true, 'priority' => 0),
			'jms'           => array('enabled' => true, 'priority' => 0),
			'normalizable'  => array('enabled' => true, 'priority' => 200),
		);


		foreach($defaultStrategies as $name => $defaults) {
			$this->addNormalizerStrategySection($strategyNodes, $name, $defaults['enabled'], $defaults['priority']);
		}

		return $node;
	}

	protected function addNormalizerStrategySection($parentNode, $name, $isEnabled = true, $priority = null)
	{
		$parentNode
			->arrayNode($name)
				->addDefaultsIfNotSet()
				->treatFalseLike(array('enabled' => false))
				->treatTrueLike(array('enabled' => true))
				->treatTrueLike(array('enabled' => true))
				->treatNullLike(array('enabled' => $isEnabled))
				->beforeNormalization()
					->ifString()
					->then(function($v){
						return array('enabled' => true, 'id' => $v, 'priority' => null);
					})
				->end()
				->children()
					->scalarNode('enabled')->defaultValue($isEnabled)->end()
					->scalarNode('id')->defaultValue('clio_component.normalizer.default_strategy.' . $name)->end()
					->scalarNode('priority')->defaultValue($priority)->end()
				->end()
		;
	}
}
