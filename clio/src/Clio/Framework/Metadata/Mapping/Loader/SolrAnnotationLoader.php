<?php
namespace Calliope\Adapter\SymfonyBundles\SolrBundle\Mapping\Loader;

class AnnotationLoader extends BaseAnnotationLoader 
{
	public function loadClassMapping(ClassMetadata $classMetadata) 
	{
		$schema = new SchemaInfo();

		// Load ClassAnnotation
		$class = $classMetadata->getReflectionClass();
		foreach($this->getAnnotationReader()->getClassAnnotations($class) as $annotation) {

			switch(true) {
			case ($annotation instanceof Mappings\Schema):
				$this->configureSchemaInfo($schema, $annotation);
				break;
			case ($annotation instanceof Mappings\Field):
				// Virtual Field
				$schema->addField($annotation);
				break;
			default:
				break;
			}
		}

		foreach($class->getProperties() as $property) {
			foreach($this->getAnnotationReader()->getPropertyAnnotations($property) as $annotation) {
				switch(true) {
				case ($annotation instanceof Mappings\Field):

					$annotation->setDefaultsFromProperty($property);
					$schema->addField($annotation);
					break;
				default:
					break;
				}
			}
		}
		
		return $schemaInfo;
	}
	
	public function getAnnotationHandler($annotation)
	{
		switch(get_class($annotation)) {
		case Mappings\Field:
			$handler = 'addField';
			break;
		}
	}

	public function applySchemaSetting($annotation)
	{
		$this->getSchema()->merge($annotation);
	}

	public function addField($annotation) 
	{
		$this->getSchema()->addField($annotation);
	}

	public function addField($annotation) 
	{
		$this->getSchema()->addField($annotation);
	}
}

