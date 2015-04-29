<?php
namespace Clio\Component\Metadata\Builder;

use Clio\Component\Metadata;
use Clio\Component\Type;

class FieldBuilder 
{
    private $schema;

    private $name;

    private $type;

    private $mappings = array();

    private $options = array();

    private $fieldTypeResolver;

    private $mappingFactories;

    public function __construct(Metadata\Resolver\FieldTypeResolver $fieldTypeResolver, Metadata\Mapping\NamedFactory $mappingFactories = null)
    {
        $this->fieldTypeResolver   = $fieldTypeResolver;
        $this->mappingFactories = $mappingFactories;
    }

    public function getFieldMetadata()
    {
        $schema = $this->getSchema();
        $field = null;

        if($schema && $schema->getType()->isType(Type\PrimitiveTypes::TYPE_CLASS)) {
             if($schema->getType()->getReflector()->hasProperty($this->getName())) {
                $field = new Metadata\Field\PropertyFieldMetadata($schema, $schema->getType()->getReflector()->getProperty($this->getName()));
             }
        }

        if(!$field) {
            $field = new Metadata\Field\FieldMetadata($schema, $this->getName());
        }

        $field->setTypeSchema($this->getFieldTypeResolver()->resolve($this->getType()));
        
        $options = $this->getFieldTypeResolver()->resolveOptions($this->getType());
        if($options) 
            $field->addOptions($options);

        //
        if($this->mappingFactories) {
            foreach($this->mappings as $mappingName => $options) {
                $schema->addMapping($this->mappingFactories->createMappingFor($mappingName, $schema, $options));
            }
        }

        return $field;
    }
    
    public function getSchema()
    {
        return $this->schema;
    }
    
    public function setSchema(Metadata\Schema $schema)
    {
        $this->schema = $schema;
        return $this;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    
    public function getFieldTypeResolver()
    {
        return $this->fieldTypeResolver;
    }
    
    public function setFieldTypeResolver(Metadata\Resolver $fieldTypeResolver)
    {
        $this->fieldTypeResolver = $fieldTypeResolver;
        return $this;
    }
    
    public function getOptions()
    {
        return $this->options;
    }
    
    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }
    
    public function getMappingFactories()
    {
        return $this->mappingFactories;
    }
    
    public function setMappingFactories(Metadata\Mapping\NamedFactory $mappingFactories)
    {
        $this->mappingFactories = $mappingFactories;
        return $this;
    }
}

