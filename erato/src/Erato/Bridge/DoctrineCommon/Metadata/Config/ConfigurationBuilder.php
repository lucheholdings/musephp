<?php
namespace Erato\Bridge\DoctrineCommon\Metadata\Config;

use Erato\Core\Metadata\Config\ConfigurationBuilder as BaseBuilder;
use Erato\Bridge\DoctrineCommon\Annotation as Annotations;
use Erato\Bridge\DoctrineCommon\Annotation\Metadata\SchemaMappingAnnotation,
	Erato\Bridge\DoctrineCommon\Annotation\Metadata\FieldMappingAnnotation
;

class ConfigurationBuilder extends BaseBuilder 
{
	public function addSchemaAnnotation(SchemaMappingAnnotation $annotation)
	{
		//switch(true) {
		//case ($annotation instanceof Annotations\Schema\Manager):
		//	$this->setManagerClass($annotation->getClass());
		//	$this->setManagerFactory($annotation->getFactory());
		//	break;
		//case ($annotation instanceof Annotations\Schema\Normalizer):
		//	$this->setNormalizer($annotation->getValue());
		//	break;
		//case ($annotation instanceof Annotations\Schema\Serializer):
		//	$this->setSerializer($annotation->getValue());
		//	break;
		//case ($annotation instanceof Annotations\Schema\Serializer):
		//	$this->setSchemifierFactory($annotation->getFactory());
		//	break;
		//case ($annotation instanceof Annotations\Schema\Fields):
		//	if($annotation->isIgnoreDefault()) {
		//		$this->setFieldTypeDefault(self::UNDEFINED_FIELD_IGNORE);
		//	} else {
		//		$this->setFieldTypeDefault(self::UNDEFINED_FIELD_GUESS);
		//	}
		//	break;
		//default:
		//	break;
		//}
		foreach($annotation->getTargetMappings() as $mapping) {
			foreach($annotation->getConfigs() as $key => $value) {
				$this->addSchemaMappingConfig($key, $value, $mapping);
			}
		}
	}

	public function addFieldAnnotation($field, FieldMappingAnnotation $annotation) 
	{
		foreach($annotation->getTargetMappings() as $mapping) {
			foreach($annotation->getConfigs() as $key => $value) {
				$this->addFieldMappingConfig($field, $key, $value, $mapping);
			}
		}
	}
}

