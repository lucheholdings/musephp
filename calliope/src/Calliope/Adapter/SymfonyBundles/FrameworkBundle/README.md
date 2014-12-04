Calliope SymfonyBundles Adapter FrameworkBundle
====

This is a Symfony Bundle to use Calliope Framework.


## Configuration

on app/config/config.yml,

	calliope_framework:
		filters:
			service_user_filter:
				class:       Service\Filter\UserFilter
				priority:    high
				arguments:
					- foo
					- bar
		schemas:
			database.user:
				type:        doctrine.orm
				class:       Entity\User

			rest.user
				type:        service
				connect_to:  terpsichore.user_service
				class:       Service\Model\User
				options:
					methods:
						create:  user.create.service_name
						update:  user.update.service_name
						delete:  user.delete.service_name
						fetch:   user.fetch.service_name

			in_service.userinfo:
				type:            model
				class:           Service\Model\UserInfo
				manager_class:   Service\UserManagre
				connect_to:      rest.user
				filters:
					- service_user_filter
				options:
					fetch_cache:     cache_provider

			complex_service.user:
				type:            decorate
				class:           Service\Model\ComplexUser
				connect_to:      rest.user
				options:
					decorate_with:
						in_service.userinfo: 
							identifiers: {id: in_service.userinfo.user_id}
					
## Configuration in bundle
  
 We also provide configuration in bundle by following way.

	# bundle_root/Resources/config/calliope.yml
	configs:
		filters:
			....
		schemas:
			...

All bundle configuration automatically merged.

CAUSION 
  app.config always overwrite the bundle configurations.
  Each bundle schema have namespaced prefix on the name.
  E.g)
    AcmeBundle has "acme." prefix on the schema name.
    This prefix automatically resolved by the bundle configuration. 

	You can change the schema name use "alias" type schema.

	simplify_schema:
		type:        alias
		connect_to:  acme.schema

## Schema and Connection Type

  - alias          Alias to point another
  - doctrine.orm   Doctrine ORM Entity
  - model          Usecase model which only schemify other.
  - decorate       Bind two or more models 
  - service        Terpsichore Service 

<!--
## Cache the response

  Calliope can cache the fetch response with criteria. 
  
  In SchemaManager, we do 

    # Use Schemifier to convert cached data to model
	$data = $cacheProvider->fetch($cacheId);
	$model = $schemaManager->denormalize($data);

	# Cache the data
	$data = $schemManager->normalize($model);
	$cacheProvider->save($cacheId, $data);
-->
