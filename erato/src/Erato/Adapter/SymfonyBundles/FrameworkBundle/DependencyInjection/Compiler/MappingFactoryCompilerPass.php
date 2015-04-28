<?php
namespace Erato\Adapter\SymfonyBundles\FrameworkBundle\DependencyInjection\Compiler;

// Symfony DI Components
use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
	Symfony\Component\DependencyInjection\Definition,
	Symfony\Component\DependencyInjection\Reference;

class MappingFactoryCompilerPass implements CompilerPassInterface
{

	public function process(ContainerBuilder $container)
    {
        $this->processSchemaMappingFactory($container);
        $this->processFieldMappingFactory($container);
    }

    protected function processSchemaMappingFactory($container)
    {
        $factories = array();
        foreach($container->findTaggedServiceIds('erato_framework.schema.schema_mapping_factory') as $id => $tags) {
            if($container->hasDefinition($id) && !$container->getDefinition($id)->isAbstract()) {
                foreach($tags as $tag) {
                    $factories[$tag['for']] = $id;
                }
            }
        }
        $container->setParameter('erato_framework.schema.schema_mapping_factories', $factories);
	}

    protected function processFieldMappingFactory($container)
    {
        $factories = array();
        foreach($container->findTaggedServiceIds('erato_framework.schema.field_mapping_factory') as $id => $tags) {
            if($container->hasDefinition($id) && !$container->getDefinition($id)->isAbstract()) {
                foreach($tags as $tag) {
                    $factories[$tag['for']] = $id;
                }
            }
        }
        $container->setParameter('erato_framework.schema.field_mapping_factories', $factories);
	}
}

