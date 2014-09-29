<?php
namespace Clio\Adapter\SymfonyBundles\GuzzleBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface
;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
/**
 * GuzzleGlobalPluginCompilerPass 
 *   This CompilerPass class appends global_plugins into ServiceBuilder
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class AuthenticationProviderCompilerPass implements CompilerPassInterface
{
	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function process(ContainerBuilder $container)
	{
		$registry = $container->getDefinition('clio.guzzle.authentication_provider_registry');
			
		if($registry) {
			foreach($container->findTaggedServiceIds('clio.guzzle.authentication_provider') as $id => $tags) {
				foreach($tags as $tag) {
					if(!array_key_exists('for', $tag)) {
						throw new \Exception('"clio.guzzle.authentication_provider" tag required "for" as identifier of the provider.');
					}
					
					// Inject by call
					$registry->addMethodCall(
						'add',
						array($tag['for'], new Reference($id))
					);
				}
			}
		}
	}
}

