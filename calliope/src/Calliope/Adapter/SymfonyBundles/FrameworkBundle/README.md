Calliope SymfonyBundles Adapter FrameworkBundle
====

This is a Symfony Bundle to use Calliope Framework.


## Configuration

on app/config/config.yml,

	calliope_framework:
		schemes:
        	scheme_alias:
				# Required.
            	class: Path\To\Namespaced\SchemeClass
				# Optional.
				manager_class: Path\To\Namespaced\ManagerClass
				# Required.
				type: [alias, doctrine.orm]
				# Required
            	connect_to:   connect_to
				# Optional.
				options:
					

