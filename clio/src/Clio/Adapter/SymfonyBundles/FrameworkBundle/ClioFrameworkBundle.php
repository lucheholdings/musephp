<?php
namespace Clio\Adapter\SymfonyBundles\FrameworkBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Clio\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler\SerializerAdapterFactoryCompilerPass;
use Clio\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler\ClassMetadataMappingFactoryCompilerPass;
use Clio\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler\FieldAccessorLayerFactoryCompilerPass;
use Clio\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler\PropertyFieldAccessorFactoryCompilerPass;

class ClioFrameworkBundle extends Bundle
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
		
		// Gather compoents tagged "metadata_manager"
		$container->addCompilerPass(new SerializerAdapterFactoryCompilerPass());
		$container->addCompilerPass(new ClassMetadataMappingFactoryCompilerPass());

	
		$container->addCompilerPass(new PropertyFieldAccessorFactoryCompilerPass());
		$container->addCompilerPass(new FieldAccessorLayerFactoryCompilerPass());

		$container->addCompilerPass(new DependencyInjection\Compiler\CounterCompilerPass());
		$container->addCompilerPass(new DependencyInjection\Compiler\KvsCompilerPass());
		$container->addCompilerPass(new DependencyInjection\Compiler\FieldMapperCompilerPass());
	}
}
