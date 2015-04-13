<?php
namespace Clio\Component\Util\Metadata\Builder;

use Clio\Component\Util\Type as Types;
use Clio\Component\Util\Metadata\Factory\MetadataFactory;
use Clio\Component\Util\Metadata\Schema;
use Clio\Component\Util\Metadata\Schema\SchemaMetadata;
use Clio\Component\Util\Metadata\Field;
use Clio\Component\Util\Metadata\Field\PropertyFieldMetadata;

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
     * factory 
     * 
     * @var mixed
     * @access private
     */
    private $factory;

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

    /**
     * options 
     * 
     * @var array
     * @access private
     */
    private $options = array();

    /**
     * typeRegistry 
     * 
     * @var mixed
     * @access private
     */
    private $typeRegistry;

    /**
     * defaultFieldsOnType 
     * 
     * @var boolean 
     * @access private
     */
    private $defaultFieldsOnType = true;

    /**
     * __construct 
     * 
     * @param Types\Registry $typeRegistry 
     * @access public
     * @return void
     */
    public function __construct(MetadataFactory $factory, Types\Registry $typeRegistry = null)
    {
        $this->factory = $factory;
        $this->typeRegistry = $typeRegistry;
        $this->defaultFieldsOnType = true;
    }

    /**
     * getSchemaMetadata 
     * 
     * @access public
     * @return void
     */
    public function getSchemaMetadata()
    {
        $schema = new SchemaMetadata($this->getType(), $this->name, array(), $this->getParent(), array(), $this->options);

        // 

        $fieldMetadatas = array();
        $fields = $this->fields;
        if($this->defaultFieldsOnType) {
            $fields = array_merge($this->getDefaultFieldsOnType($schema), $fields);
        }

        if(!empty($fields)) {
            foreach($fields as $fieldName => $fieldType) {
                if($fieldType instanceof Field) {
                    $fieldMetadatas[$fieldName] = $fieldType;
                } else {
                    $fieldMetadatas[$fieldName] = $this->factory->createFieldMetadata($schema, $fieldName, $fieldType);
                }
            }
            $schema->setFields($fieldMetadatas);
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
            if(!$this->typeRegistry) {
                throw new \RuntimeException('Type cannot solve by typeRegistry, cause TypeRegsitry is not specified.');
            }
            $this->type = $this->typeRegistry->get($this->type);
        }
        return $this->type;
    }
    
    /**
     * getTypeRegistry 
     * 
     * @access public
     * @return void
     */
    public function getTypeRegistry()
    {
        return $this->typeRegistry;
    }
    
    /**
     * setTypeRegistry 
     * 
     * @param Types\Registry $typeRegistry 
     * @access public
     * @return void
     */
    public function setTypeRegistry(Types\Registry $typeRegistry)
    {
        $this->typeRegistry = $typeRegistry;
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
    public function setParent(Schema $parent)
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
     * setFields 
     * 
     * @param array $fields 
     * @access public
     * @return void
     */
    public function setFields(array $fields)
    {
        $this->fields = array();
        foreach($fields as $name => $field) {
            $this->setField($name, $field);   
        }
        return $this;
    }

    /**
     * addField 
     * 
     * @param mixed $fieldName 
     * @param mixed $type 
     * @access public
     * @return void
     */
    public function addField($fieldName, $typeSchema = null)
    {
        $this->fields[$fieldName] = $typeSchema;
        return $this;
    }

    /**
     * enableDefaultFieldsOnType 
     * 
     * @access public
     * @return void
     */
    public function enableDefaultFieldsOnType()
    {
        $this->defaultFieldsOnType = true;
        return $this;
    }

    /**
     * disableDefaultFieldsOnType 
     * 
     * @access public
     * @return void
     */
    public function disableDefaultFieldsOnType()
    {
        $this->defaultFieldsOnType = false;
        return $this;
    }

    /**
     * getDefaultFieldsOnType 
     * 
     * @access public
     * @return void
     */
    public function getDefaultFieldsOnType(Schema $schema)
    {
        $fields = array();
        $type = $this->getType();
        if($type instanceof Types\Actual\ClassType) {
            $properties = $type->getReflector()->getProperties();

            foreach($properties as $property) {
                $fields[$property->getName()] = new PropertyFieldMetadata($schema, $property);
            }
        }

        return $fields;
    }
}

