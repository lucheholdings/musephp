Clio.Framework
====

Clio.Framework is a Package to use Clio as a Framework. 

On Clio.Framework, we use Metadata and Mapping to solve any configuration of the schema.


## Ideal of Usage

    $metadata = $metadataRegistry->get('Namespaced\Class\Path');
    
    // Way to get Schema Accessor
    $accessor = $metadata->getMapping('accessor')->getAccessor();
    $accessor->set($data, 'foo', 'Foo')->set($data, 'bar', 'Bar');
    $accessor->isNull($data, 'foo');
    $accessor->get($data, 'foo');
    
    // Way to get Data Accessor
    $accessor = $metadata->getMapping('accessor')->getAccessor($data);
    $accessor->set('foo', 'Foo')->set('bar', 'Bar');
    $accessor->isNull('foo');
    $accessor->get('foo');
    
    // Simplest way to use Normalizer with class.
    $metadata->getMapping('normalizer')->denomalize($data);
    // or
    $normalizer->denormalize($data, $metadata);
    
    // Validate data
    $metadata->getMapping('validator')->validate($data);
    
    // Schemifier
    $metadata->getMapping('schemifier')->schemify($data);
    
    
    // Construct new object
    $metadata->construct();




Extends Mappings
----------

you can add any Mapping into Metadata, if the mapping is schema unique.





# Calliope Extension

  CalliopeFramework is another Framework to map Metadata for each model in each usecase, over ClioFramework.

  
  Schema Model is different from a Class, but its stored on Database.



