Terpsichore OAuth2 ServerBundle
====


Installation
----



Configuration
----

    terpsichore_oauth2_server:
		# Scope Delemiter 
		scope_delemiter:  ' '
		
		authentication_provider:
			# Use AuthenticationProvider or not
			# 
			enabled: true
		
		grant_types:
			client_credentials: ~
			user_credentials: ~
			authorization_code: ~
			refresh_token: ~

		# to use chained grant, you have to specify at least one chain provider.
		chain_provider:
			google: ~
			facebook: ~
			twitter: ~

			

