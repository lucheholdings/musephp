<?php

namespace Clio\Adapter\SymfonyBundles\GuzzleBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Clio\Adapter\SymfonyBundles\GuzzleBundle\DependencyInjection\Compiler\GuzzleGlobalPluginCompilerPass;
use Clio\Adapter\SymfonyBundles\GuzzleBundle\DependencyInjection\Compiler\AuthenticationProviderCompilerPass;

/**
 * ClioGuzzleBundle 
 * 
 * @uses Bundle
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class ClioGuzzleBundle extends Bundle
{
	/**
	 * build 
	 * 
	 * @param ContainerBuilder $container 
	 * @access public
	 * @return void
	 */
	public function build(ContainerBuilder $container)
	{
		parent::build($container);

		$container->addCompilerPass(new GuzzleGlobalPluginCompilerPass());
		$container->addCompilerPass(new AuthenticationProviderCompilerPass());
	}
}
