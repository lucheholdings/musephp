<?php
namespace Clio\Adapter\SymfonyBundles\GuzzleBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface
;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
/**
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class GuzzleClientConfigCompilerPass implements CompilerPassInterface
{
	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function process(ContainerBuilder $container)
	{
		foreach($container->findTaggedServiceIds('guzzle.client.config') as $id => $tags) {
			foreach($tags as $tag) {
				if(!array_key_exists('name', $tag)) {
					throw new \Exception('"guzzle.client.config" tag required "name" attribute.');
				}

				if(array_key_exists('id', $tag)) {
				} else if(!array_key_exists('value', $tag)) {
					$value = $tag['value'];
					throw new \Exception('"guzzle.client.config" tag required "name" attribute.');
					throw new \Exception('"guzzle.client.config" tag required "name" attribute.');
				}

				switch($tag['type']) {
				case 'cache':
					$this->injectGlobalCachePlugin($container, $id, $tag);
					break;
				default:
					throw new \Exception('Unknown type "%s" for "guzzle.global_plugin" is given.', $tag['type']);
				}
			}
		}
	}

	protected function injectGlobalCachePlugin(ContainerBuilder $container, $id, $tag)
	{
		$serviceBuilderDefinition = $container->findDefinition($id);
		if(!$serviceBuilderDefinition) {
			throw new \Exception(sprintf('Definition "%s" is not found on ContainerBuilder.', $id));
		}

		$cacheDefinition = $container->findDefinition($tag['name']);
		if(!$cacheDefinition) {
			throw new \Exception(sprintf('Definition "%s" is not found on ContainerBuilder.', $id));
		}

		$cachePluginId = $id.'.cache';
		$cacheAdapterId = $id.'.cache_adapter';

		$refClass = new \ReflectionClass($cacheDefinition->getClass());

		// select cache adapter class 
		if($refClass->implementsInterface('\Doctrine\Common\Cache\Cache')) {
			$cacheAdapterClass = $container->getParameter('guzzle.cache.adapter.doctrine.class');
		} else {
			throw new \Exception(sprintf('class "%s" is not supported for guzzle cache.', $refClass->getName()));
		}
		//
		$container->setDefinition(
			$cacheAdapterId,
			new Definition(
				$cacheAdapterClass,
				array(new Reference($tag['name']))
			)
		);


		$cachePluginClass = $container->getParameter('guzzle.plugin.cache.class');
		$container->setDefinition(
			$cachePluginId, 
			new Definition(
				$cachePluginClass,
				array('options' => array(
					'adapter' => new Reference($cacheAdapterId)
				))
			)
		);
		$serviceBuilderDefinition->addMethodCall(
			'addGlobalPlugin',
			array(new Reference($cachePluginId))
		);
	}
}

