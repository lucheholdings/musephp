Erato FrameworkBundle 
===

Erato FrameworkBundle is a Symfony Bundle to use EratoFramework on Symfony2.

Be care, Erato Registry is Schema Unique. It means that one class has only one SchemaMetadata on the registry.
If you need more Metadata for the specified Metadata, then use Clio\Extra\Metadata\UsecaseSchemaMetadata instead.


## Installation

### With composer

	{
		"require": {
			...
			"museerato/symfony-framwork-bundle" : "master" 
		}
	}


## Default Metadata Mappings

  * attributes : Schema Mapping for AttributeMapAware class 
  * tags : Schema Mapping for TagSetAware class 
  * accessor : Accessor Configuration for Schema and Field
  * normalizer: Normalizer Configuration for Schema
  * validator: Field validator configuration
  * schemifier: Schemifier configuration for schema

## Configuration with Defaults 
	
	
	erato_framework:
		# Cache Metadata and Mapping
		cache:
			enabled:   true
			# Choose "doctrine.xxxx" or "alias" with id
			# For more detail on cache type, see clio_component.cache.factory
			type:      doctrine.filesystem
			id:        ~
			options:
				directory:   %kernel.cache_dir%/erato_metadata
				extensions:  .cache.php
		mappings:
			attributes:
				class:        Clio\Component\Util\Attribute\SimpleAttribute 
				fieldname:    attributes 

			tags:
				class:        Clio\Component\Util\Tag\SimpleTag
				fieldname:    tags

			# 
			merger:
				ignore_underscored:  true
				ignore_fields:       []

			#  
			replacer:
				ignore_underscored:  true
				ignore_fields:       []

			# Use Accessor Mapping
			accessor:
				enabled:  true

			# Use normalizer Mapping for Schema or Schema Fields
			normalizer:
				enabled:  true
				# you can use "erato_framework.normalizer.jms" as well.
				defualt_normalizer:   erato_framework.normalizer

			# Use serializer Mapping for Schema or Schema Fields 
			serializer:
				enabled:  true
				default_serialzier:   erato_framework.serializer
			

## Sample Usage
	
	$registry = $registry->get('erato_framework.schema.registry');

	$metadata = $registry->get(Namespaced\ClassPath);
	// Create new instance of the class.
	$data = $metadata->construct();

	$normalizedData = $metadata->getMapping('normalizer')->normalize($data);

	$serialized = $metadata->getMapping('serializer')->serialize($data, 'json');

	$accessor = $metadata->getMapping('accessor')->getAccessor($data);
	$accessor->get('property');
	$accessor->set('property', $newValue);

