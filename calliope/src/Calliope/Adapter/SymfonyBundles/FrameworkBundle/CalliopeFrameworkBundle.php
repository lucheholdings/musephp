<?php

namespace Calliope\Adapter\SymfonyBundles\FrameworkBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Calliope\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler\SchemeManagerCompilerPass,
	Calliope\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler\TypeConnectionFactoryCompilerPass;

/**
 * CalliopeFrameworkBundle 
 * 
 * @uses Bundle
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class CalliopeFrameworkBundle extends Bundle
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
		$container->addCompilerPass(new SchemeManagerCompilerPass());
		$container->addCompilerPass(new TypeConnectionFactoryCompilerPass());
		$container->addCompilerPass(new DependencyInjection\Compiler\FilterCompilerPass());
		$container->addCompilerPass(new DependencyInjection\Compiler\FilterFactoryCompilerPass());
	}
}
