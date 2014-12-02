<?php
namespace Erato\Core\Metadata\Config;

class ConfigurationBuilder 
{
	const UNDEFINED_FIELD_IGNORE = 0;
	const UNDEFINED_FIELD_GUESS  = 1; 

	private $options = array();

	public function setManagerClass($class)
	{
		$this->addSchemaMappingConfig('manager_class', $class, 'schema_manager');
	}

	public function setManagerFactory($factory)
	{
		$this->addSchemaMappingConfig('factory', $factory, 'schema_manager');
	}

	public function setNormalizer($service)
	{
		$this->addSchemaMappingConfig('normalizer', $service, 'normalizer');
	}

	public function setSerializer($service)
	{
		$this->addSchemaMappingConfig('serializer', $service, 'serializer');
	}

	public function setSchemifierFactory($service)
	{
		$this->addSchemaMappingConfig('factory', $service, 'schemifier');
	}

	public function setFieldTypeDefault($type)
	{
		$this->fieldTypeDefault = $type;
	}

	public function setFieldType($field, $type)
	{
		$this->addFieldMappingConfig($field, 'type', $type, 'metadata');
	}

	public function setFieldName($field, $name)
	{
		$this->addFieldMappingConfig($field, 'name', $name, 'metadata');
	}

	public function build()
	{
		if(isset($this->options['mappings']['metadata'])) {
			foreach($this->options['mappings']['metadata'] as $key => $value) {
				if('mappings' == $key) {
					throw new \RuntimeException('options "mappings" is reserved keyword for Schema.');
				}
				$this->options[$key] = $value;
			}

			unset($this->options['mappings']['metadata']);
		}

		if(isset($this->options['fields'])) {
			foreach($this->options['fields'] as $field => $fieldOptions) {
				if(isset($fieldOptions['mappings']['metadata'])) {
					foreach($fieldOptions['mappings']['metadata'] as $key => $value) {
						if('mappings' == $key) {
							throw new \RuntimeException(sprintf('options "mappings" is reserved keyword for Field "%s".', $field));
						}
						$this->options['fields'][$field][$key] = $value;
					}
					unset($this->options['fields'][$field]['mappings']['metadata']);
				}
			}
		}
		return new Configuration($this->options);
	}

	protected function buildSchemaConfigs($options)
	{
		return $this->schemaConfigs;
	}

	protected function buildFieldConfigs($field, array $options)
	{
		if(isset($options['type'])) {
			switch($this->fieldTypeDefault) {
			case self::UNDEFINED_FIELD_IGNORE:
				return false;
				break;
			case self::UNDEFINED_FIELD_GUESS:
			default:
				// keep going
				break;
			}
		}
		return $this->fieldConfigs;
	}

	public function addSchemaMappingConfig($key, $value, $mapping)
	{
		if(!isset($this->options['mappings'])) {
			$this->options['mappings'] = array();
		}

		if(!isset($this->options['mappings'][$mapping])) {
			$this->options['mappings'][$mapping] = array();
		}

		if(!isset($this->options['mappings'][$mapping][$key])) {
			$this->options['mappings'][$mapping][$key] = $value;
		} else {
			$this->options['mappings'][$mapping][$key] 
				= $this->doMergeConfig($this->options['mappings'][$mapping][$key], $value);
		}
	}

	public function addFieldMappingConfig($field, $key, $value, $mapping)
	{
		if(!isset($this->options['fields'])) {
			$this->options['fields'] = array();
		}

		if(!isset($this->options['fields'][$field])) {
			$this->options['fields'][$field] = array();
		}

		if(!isset($this->options['fields'][$field]['mappings'])) {
			$this->options['fields'][$field]['mappings'] = array();
		}

		if(!isset($this->options['fields'][$field]['mappings'][$key])) {
			$this->options['fields'][$field]['mappings'][$mapping][$key]  = $value;
		} else {
			$this->options['fields'][$field]['mappings'][$mapping][$key] 
				= $this->doMergeConfig($this->options['fields'][$field]['mappings'][$mapping][$key], $value);
		}
	}

	protected function doMergeConfig($first, $second)
	{
		if(!is_array($first)) {
			return $second;
		}

		foreach($second as $key => $value) {
			if(!isset($first[$key])) {
				$first[$key] = $value;
			} else if(is_scalar($first[$key]) || is_scalar($value)) {
				$first[$key] = $value;
			} else {
				$first[$key] = $this->doMergeOptions($first[$key], $value);
			}
		}
		
		return $first;
	}

	public function setFieldConfig($field, $key, $value)
	{
		if('mappings' == $key) {
			throw new \InvalidArgumentException('mappings is reserved keyword.');
		}
		$this->options[$field][$key] = $value;
	}

}

