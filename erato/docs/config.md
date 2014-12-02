# Configuration

## Configuration Load Setting

### On Symfony FrameworkBundle

    # config.yml
	erato_framework:
		# Following configuration means
		# 1. If yaml config exits, then load yaml config.
		# 2. If yaml is not exists and xml exists, then load xml config
		# 3. If yaml and xml are not exists and json exists, then load json config
		# 4. Load annotation and overwrite(merge) previous config if needed.
		config_loader: [[yml, xml, json], annotation]

		# Following configuration means
		# 1. If yaml config exits, then load yaml config.
		# 2. Load annotation and overwrite(merge) previous config if needed.
		config_loader: [yml, annotation]

		# Or
		# Following configuration means
		# 1. just try annotation. if not specified any, then default
		config_loader: annotation

## Yaml Configuration

	# Namespaced.Class.Name.yml
	schema:
		fields:	
			foo:
				type:  integer
				accessor:
					type:  method
			bar:
				type:  mixed
				accessor:
					type: ignore
		normalizer:     normalizer.service_name
		serializer:     serializer.service_name
		schemifier:
			factory:    factory.service_name
			mappers:
				Namespced\Class\From:
					from_field:       to_field
					from_field2:      to_field2

## Json Configuration


## XML Configuration

## Annotation Configuration (Overwrite Yaml, Json, XML Configuration)

    use Erato\Adapter\SymfonyBundles\FrameworkBundle\Annotations\Schema;
    /**
     * 
     * @Schema\Fields(ignore_default=true)
     * @Schema\Normalizer("custom.normalizer_name.in_normalizer_registry")
     */
    class Hoge
    {
	    
    }



