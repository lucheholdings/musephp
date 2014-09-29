<?php

namespace Calliope\Adapter\SymfonyBundles\MediaExtensionBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use Calliope\Adapter\SymfonyBundles\MediaExtensionBundle\DependencyInjection\Compiler\TypeMediaFactoryCompilerPass;
use Calliope\Adapter\SymfonyBundles\MediaExtensionBundle\DependencyInjection\Compiler\MediaCompilerPass;

class CalliopeMediaExtensionBundle extends Bundle
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

		// Gather components tagged "metadata_manager"
		$container->addCompilerPass(new TypeMediaFactoryCompilerPass());
		$container->addCompilerPass(new MediaCompilerPass());
	}
}
