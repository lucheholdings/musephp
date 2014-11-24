<?php
namespace Erato\Adapter\SymfonyBundles\FrameworkBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use Erato\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler;

class EratoFrameworkBundle extends Bundle
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
		
		$container->addCompilerPass(new Compiler\AccessorCompilerPass());
		$container->addCompilerPass(new Compiler\NormalizerCompilerPass());
		$container->addCompilerPass(new Compiler\MetadataCompilerPass());
		//$container->addCompilerPass(new Compiler\CacheCompilerPass());

		// Gather compoents tagged "metadata_manager"
		//$container->addCompilerPass(new SerializerAdapterFactoryCompilerPass());
		//$container->addCompilerPass(new ClassMetadataMappingFactoryCompilerPass());

	
		//$container->addCompilerPass(new PropertyFieldAccessorFactoryCompilerPass());
		//$container->addCompilerPass(new FieldAccessorLayerFactoryCompilerPass());

		//$container->addCompilerPass(new DependencyInjection\Compiler\CounterCompilerPass());
		//$container->addCompilerPass(new DependencyInjection\Compiler\KvsCompilerPass());
		//$container->addCompilerPass(new DependencyInjection\Compiler\FieldMapperCompilerPass());
	}
}
