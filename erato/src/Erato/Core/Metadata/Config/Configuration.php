<?php
namespace Erato\Core\Metadata\Config;

use Clio\Component\Util\Metadata\SchemaMetadata;
use Clio\Component\Util\Metadata\Field\Type;

class Configuration 
{
	private $configs;

	public function __construct(array $configs)
	{
		$this->configs = $configs;
	}

	public function apply(SchemaMetadata $metadata)
	{
		if(isset($this->configs['mappings'])) {
			foreach($this->configs['mappings'] as $mappingName => $mappingConfigs) {
				if($metadata->hasMapping($mappingName)) {
					$metadata->getMapping($mappingName)->mergeOptions($mappingConfigs);
				}
			}
		}

		if(isset($this->configs['fields'])) {
			foreach($this->configs['fields'] as $fieldName => $fieldConfigs) {
				if($metadata->hasField($fieldName)) {
					$field = $metadata->getField($fieldName);
					foreach($fieldConfigs as $key => $value) {
						switch($key) {
						case 'type':
							$field->setType(new Type($value));
							break;
						case 'name':
							$field->setName($value);
							break;
						case 'mappings':
							foreach($value as $mappingName => $mappingConfigs) {
								if($field->hasMapping($mappingName)) {
									$mapping = $field->getMapping($mappingName);
									$mapping->mergeOptions($mappingConfigs);
								}
							}
							break;
						default:
							$field->setOption($key, $value);
							break;
						}
					}
				}

			}
		}

		//foreach($metadata->getFields() as $fieldName => $field) {
		//	if(isset($this->configs['fields'][$fieldName])) {
		//		// configure field
		//		if(isset($this->configs['fields'][$fieldName]['type'])) {
		//			$metadata->getField($fieldName)->setType(new Type($this->configs['fields'][$fieldName]['type']));
		//		}
		//		if(isset($this->configs['fields'][$fieldName]['name'])) {
		//			$metadata->getField($fieldName)->setName($this->configs['fields'][$fieldName]['name']);
		//		}

		//		foreach($this->configs['fields'][$fieldName]['mappings'] as $mappingName => $mappingConfigs) {
		//			if($field->hasMapping($mappingName)) {
		//				$field->getMapping($mappingName)->mergeOptions($mappingConfigs);
		//			}
		//		}

		//		// Update options
		//		if(isset($this->configs['fields'][$fieldName]['options'])) {
		//			$field->setOptions(array_merge($field->getOptions(), $this->configs['fields'][$fieldName]['options']));
		//		}
		//	} else {
		//		// fixme : default ?
		//	}
		//}
	}
}

