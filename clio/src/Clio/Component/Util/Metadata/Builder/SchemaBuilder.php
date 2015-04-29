<?php
namespace Clio\Component\Util\Metadata\Builder;

use Clio\Component\Util\Type as Types;
use Clio\Component\Util\Metadata;

/**
 * SchemaBuilder 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemaBuilder 
{
    /**
     * mappingFactories 
     * 
     * @var mixed
     * @access private
     */
    private $mappingFactories;

    private $fieldMappingFactories;

    /**
     * schemaResolver 
     * 
     * @var mixed
     * @access private
     */
    private $schemaResolver;

    /**
     * typeResolver 
     * 
     * @var mixed
     * @access private
     */
    private $typeResolver;

    /**
     * name 
     * 
     * @var mixed
     * @access private
     */
    private $name;

    /**
     * type 
     * 
     * @var mixed
     * @access private
     */
    private $type;

    /**
     * parent 
     * 
     * @var mixed
     * @access private
     */
    private $parent;

    /**
     * fields 
     * 
     * @var array
     * @access private
     */
    private $fields = array();

    private $mappings = array();

    /**
     * options 
     * 
     * @var array
     * @access private
     */
    private $options = array();

    /**
     * __construct 
     * 
     * @param Types\Resolver $typeResolver 
     * @access public
     * @return void
     */
    public function __construct(Metadata\Resolver $schemaResolver, Types\Resolver $typeResolver, Metadata\Mapping\NamedFactory $mappingFactories = null, Metadata\Mapping\NamedFactory $fieldMappingFactories = null) 
    {
        $this->schemaResolver = $schemaResolver;
        $this->typeResolver = $typeResolver;
        $this->mappingFactories = $mappingFactories;
        $this->fieldMappingFactories = $fieldMappingFactories;
    }

    /**
     * getSchemaMetadata 
     * 
     * @access public
     * @return void
     */
    public function getSchemaMetadata()
    {
        $schema = new Metadata\Schema\SchemaMetadata($this->getType(), $this->name, array(), null, array(), $this->options);

        if($this->parent) {
            $schema->setParent($this->schemaResolver->resolve($this->parent));
        }

        // 
        if(!empty($this->fields)) {
            foreach($this->fields as $fieldName => $fieldConfig) {
                $fieldBuilder = $this->createFieldBuilder();
                $fieldBuilder
                    ->setSchema($schema)
                    ->setName($fieldConfig['name'])
                    ->setType($fieldConfig['type'])
                    ->setOptions($fieldConfig['options'])
                ;
                $schema->setField($fieldName, $fieldBuilder->getFieldMetadata());
            }
        }

        if($this->mappingFactories) {
            $schema->setMappings($this->mappingFactories->createMappings($schema, $this->mappings));
        }

        return $schema;
    }

    /**
     * setName 
     * 
     * @access public
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * setType 
     * 
     * @param mixed $type 
     * @access public
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * getType 
     * 
     * @access public
     * @return void
     */
    public function getType()
    {
        if(!$this->type instanceof Types\Type) {
            if(!$this->typeResolver) {
                throw new \RuntimeException('Type cannot solve, because TypeResolver is not specified.');
            }
            $this->type = $this->typeResolver->resolve($this->type);
        }
        return $this->type;
    }
    
    /**
     * getTypeResolver 
     * 
     * @access public
     * @return void
     */
    public function getTypeResolver()
    {
        return $this->typeResolver;
    }
    
    /**
     * setTypeResolver 
     * 
     * @param Types\Resolver $typeResolver 
     * @access public
     * @return void
     */
    public function setTypeResolver(Types\Resolver $typeResolver)
    {
        $this->typeResolver = $typeResolver;
        return $this;
    }
    
    /**
     * getParent 
     * 
     * @access public
     * @return void
     */
    public function getParent()
    {
        return $this->parent;
    }
    
    /**
     * setParent 
     * 
     * @param Schema $parent 
     * @access public
     * @return void
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }
    
    /**
     * getOptions 
     * 
     * @access public
     * @return void
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * setOptions 
     * 
     * @param array $options 
     * @access public
     * @return void
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * addOption 
     * 
     * @param mixed $key 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function addOption($key, $value)
    {
        $this->options[$key] = $value;
        return $this;
    }
    
    /**
     * getFields 
     * 
     * @access public
     * @return void
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * hasField 
     * 
     * @param mixed $fieldName 
     * @access public
     * @return void
     */
    public function hasField($fieldName)
    {
        return isset($this->fields[$fieldName]);
    }

    /**
     * addField 
     * 
     * @param mixed $fieldName 
     * @param mixed $type 
     * @access public
     * @return void
     */
    public function addField($fieldName, $type = 'mixed', array $options = array(), array $mappings = array())
    {
        $this->fields[$fieldName] = array(
                'name'     => $fieldName, 
                'type'     => $type,
                'options'  => $options, 
                'mappings' => array(),
            );

        foreach($mappings as $mappingName => $mappingOptions) {
            $this->addFieldMapping($fieldName, $mappingName, $mappingOptions);
        }
        return $this;
    }

    /**
     * appendProperties 
     * 
     * @access public
     * @return void
     */
    public function appendProperties()
    {
        // if class type
        if($this->getType()->isType('class')) {
            foreach($this->getType()->getReflector()->getProperties() as $prop) {
                if(!$this->hasField($prop->getName())) {
                    $this->addField($prop->getName());
                }
            }
        }
        return $this;
    }
    
    public function hasMapping($name)
    {
        return isset($this->mappings[$name]);
    }
    
    public function addMapping($name, array $options = array())
    {
        $this->mappings[$name] = $options;
        return $this;
    }

    public function hasFieldMapping($field, $mappingName)
    {
        return $this->hasField($field) && isset($this->fields[$field]['mappings'][$mappingName]);
    }
    
    public function getFieldMapping($field, $mappingName)
    {
        if($this->hasField($field)) 
            throw new \InvalidArgumentException(sprintf('Field "%s" is not exists.', $field));

        if(isset($this->fields[$field]['mappings'][$mappingName])) {
            throw new \InvalidArgumentException(sprintf('Mapping "%s" is not exists for Field "%s".', $mappingName, $field));
        }
        return $this->fields[$field]['mappings'][$mappingName];
    }
    
    public function addFieldMapping($field, $mappingName, array $options = array())
    {
        if(!$this->hasField($field)) {
            $this->addField($field);
        }
        $this->fields[$field]['mappings'][$mappingName] = $options;
        return $this;
    }

    public function createFieldBuilder()
    {
        return new FieldBuilder(new Metadata\Resolver\FieldTypeResolver($this->schemaResolver), $this->fieldMappingFactories);
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

