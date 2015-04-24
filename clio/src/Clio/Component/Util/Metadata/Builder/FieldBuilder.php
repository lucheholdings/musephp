<?php
namespace Clio\Component\Util\Metadata\Builder;

use Clio\Component\Util\Metadata;
use Clio\Component\Util\Type;

class FieldBuilder 
{
    private $schema;

    private $name;

    private $type;

    private $options = array();

    private $schemaResolver;

    public function __construct(Metadata\Resolver $schemaResolver)
    {
        $this->schemaResolver = $schemaResolver;
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

        $field->setTypeSchema($this->getSchemaResolver()->resolve($this->getType()));
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
    
    public function getSchemaResolver()
    {
        return $this->schemaResolver;
    }
    
    public function setSchemaResolver(Metadata\Resolver $schemaResolver)
    {
        $this->schemaResolver = $schemaResolver;
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
}

