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
			->end()
		;

        return $treeBuilder;
    }

	protected function buildNormalizerSection()
	{
		$treeBuilder = new TreeBuilder();
		$node = $treeBuilder->rootNode('normalizer');

		$node
			->canBeDisabled()
			->addDefaultsIfNotSet()
			->children()
				->arrayNode('strategies')
			->end()
		;

		$strategyNodes = $node->getChild('strategies')->children();
		

		foreach(array() as $name) {
			$this->addNormalizerStrategySection($strategyNodes, $name);
		}

		return $node;
	}

	protected function addNormalizerStrategySection($parentNode)
	{
		$parentNode
			->arrayNode($name)
				->canBeDisabled()
				->beforeNormalization()
					->ifString()
					->then(function($v){
						return array('enabled' => true, 'id' => $v);
					})
				->end()
				->children()
					->scalarNode('id')->defaultValue('clio_component.normalizer.default_strategy.' . $name)
				->end()
		;
	}
}
