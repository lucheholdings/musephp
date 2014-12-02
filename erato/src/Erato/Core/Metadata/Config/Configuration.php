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
		foreach($this->configs['mappings'] as $mappingName => $mappingConfigs) {
			if($metadata->hasMapping($mappingName)) {
				$metadata->getMapping($mappingName)->mergeOptions($mappingConfigs);
			}
		}

		foreach($metadata->getFields() as $fieldName => $field) {
			if(isset($this->configs['fields'][$fieldName])) {
				// configure field
				if(isset($this->configs['fields'][$fieldName]['type'])) {
					$metadata->getField($fieldName)->setType(new Type($this->configs['fields'][$fieldName]['type']));
				}
				if(isset($this->configs['fields'][$fieldName]['name'])) {
					$metadata->getField($fieldName)->setName($this->configs['fields'][$fieldName]['name']);
				}

				foreach($this->configs['fields'][$fieldName]['mappings'] as $mappingName => $mappingConfigs) {
					if($field->hasMapping($mappingName)) {
						$field->getMapping($mappingName)->mergeOptions($mappingConfigs);
					}
				}
			} else {
				// fixme : default ?
			}
		}
	}
}

