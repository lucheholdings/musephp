


    terpsichore_oauth2_server:
		scope_delemiter:  ' '
		token_resolver:   server|tokeninfo|trust
		default_scopes:   []
		server:
			#use_auth_provider:  true|false

			# Bshaffer Storage
			storages:
				# Storages for AuthenticationProvider
				user_credentials:
					class:      Path\To\Fully\Qualified
					type:       doctrine.orm
					connect_to: entity_manager
				client:
					class:      Path\To\Fully\Qualified
					type:       doctrine.cache
					connect_to: service_id
				scope:          service_id
				
				# Storages for AuthorizationCheck
				access_token:
					...
				refresh_token:
					...
				authrorization_code:
					...
			# Bshaffer GrantTypes
			grant_types:
				# false to disabl
				client_credentials: ~|false
				user_credentials:   ~
				authorization_code: ~
				refresh_token:      ~
				extra:              service_id
			configs:
				# Bshaffer OAuth2 configuration
				enforce_state:   false


	# Without AuthenticationProvider Setting 
	# As Facebook client 
    terpsichore_oauth2_server:
		scope_delemiter:  ' '
		token_resolver:   trust

