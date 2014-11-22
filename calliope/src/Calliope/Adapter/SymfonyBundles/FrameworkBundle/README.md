Calliope SymfonyBundles Adapter FrameworkBundle
====

This is a Symfony Bundle to use Calliope Framework.


## Configuration

on app/config/config.yml,

	calliope_framework:
		schemes:
        	scheme_alias:
				# Required.
				type: [model, doctrine.orm, reference, decorate]
				# Required.
            	class: Path\To\Namespaced\SchemaClass
				# Optional.
				manager_class: Path\To\Namespaced\ManagerClass
				# Required
            	connect_to:   connect_to
				# Optional.
				options:
					key: value
			doctrine_entity:
				type:        doctrine.orm 
				class:       Path\To\Namespaced\EntityClass
				connect_to:  doctrine_entity_manager
			model_sample:
				type:        model
				class:       Path\To\Namespaced\ModelClass
				connect_to:  doctrine_entity
			reference_sample:
				type:        reference
				connect_to:  base_schema_alias
			decorate_sample:
				type:        decorate
				class:       Path\To\Namespaced\DecratedModelClass
				connect_to:  base_schema_alias
				options:
					decorates:    decorator_schema_alias
					identifiers:  { main_id: decorate_id }
					cache:        cache_provider_id
			rest_sample:
				type:        rest
				class:       Path\To\Namespaced\ModelClass
				connect_to:  terpsichore_client_id
				options:
					methods:
						create:     terpsichore.create.service_name
						update:     terpsichore.update.service_name
						delete:     terpsichore.delete.service_name
						fetch:      terpsichore.fetch.service_name

					
## Schema and Connection Type

  - doctrine.orm
  - model
  - reference
  - decorate
  - rest

## Cache the response

  Calliope can cache the fetch response with criteria. 
  
  In SchemaManager, we do 

    # Use Schemifier to convert cached data to model
	$data = $cacheProvider->fetch($cacheId);
	$model = $schemaManager->denormalize($data);

	# Cache the data
	$data = $schemManager->normalize($model);
	$cacheProvider->save($cacheId, $data);
