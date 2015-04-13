<?php
namespace Clio\Component\Util\Metadata\Schema;

use Clio\Component\Util\Metadata\AbstractMetadata;
use Clio\Component\Util\Metadata\Schema;
use Clio\Component\Util\Metadata\Field;
use Clio\Component\Util\Type as Types;

/**
 * SchemaMetadata 
 * 
 * @uses AbstractMetadata
 * @uses Schema
 * @uses Types
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemaMetadata extends AbstractMetadata implements Schema, Types\Type
{
    /**
     * type 
     *   Actual type of Schema 
     * @var mixed
     * @access Types\Type 
     */
    protected $type;

    /**
     * fields 
     * 
     * @var mixed
     * @access protected
     */
    protected $fields;

    /**
     * __construct 
     * 
     * @param Type $type 
     * @param mixed $name 
     * @param array $fields 
     * @param Schema $parent 
     * @access public
     * @return void
     */
    public function __construct(Types\Type $type, $name = null, array $fields = array(), Schema $parent = null, array $mappings = array(), array $options = array())
    {
        $this->type = $type;
        if(!$name) {
            $name = $this->type->getName();
        }
        parent::__construct($name, $mappings, $options, $parent);

        $this->fields = array();
        foreach($fields as $key => $field) {
            $this->setField($key, $field);
        }
    }

    /**
     * newInstance 
     * 
     * @access public
     * @return void
     */
    public function newInstance()
    {
        return $this->newInstanceArgs(func_get_args());
    }

    /**
     * newInstanceArgs 
     * 
     * @param array $args 
     * @access public
     * @return void
     */
    public function newInstanceArgs(array $args = array())
    {
        if($this->hasMapping('constructor')) {
            return $this->getMapping('constructor')->construct($this->getType(), $args);
        } else if($this->getType() instanceof Types\Instantiatable) {
            return $this->getType()->newInstanceArgs($args);
        }

        throw new \RuntimeException('Schema "%s" is not instantiatable');
    }
    
    /**
     * setParent 
     *   Set parent Schema or name of the parent.
     *   If parent name is setted, please warmup this metadata before use.
     * 
     * @param mixed $parent 
     * @access public
     * @return void
     */
    public function setParent($parent)
    {
        if(!is_string($parent) && !$parent instanceof Schema) {
            throw new \InvalidArgumentException('Parent has to be a Schema');
        }
        parent::setParent($parent);
        return $this;
    }

    /**
     * getTypeName 
     * 
     * @access public
     * @return void
     */
    public function getTypeName()
    {
        return $this->type->getName();
    }
    
    /**
     * getType 
     * 
     * @access public
     * @return void
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * setType 
     * 
     * @param mixed $type 
     * @access public
     * @return void
     */
    public function setType(Types\Type $type)
    {
        $this->type = $type;
        return $this;
    }
    
    /**
     * getFields 
     * 
     * @access public
     * @return void
     */
    public function getFields($includeParent = true)
    {
        if($includeParent && $this->hasParent()) {
            return array_merge($this->getParent()->getFields(), $this->fields);
        }

        return $this->fields;
    }
    
    /**
     * setFields 
     * 
     * @param mixed $fields 
     * @access public
     * @return void
     */
    public function setFields(array $fields)
    {
        $this->fields = array();
        foreach($fields as $key => $field) {
            $this->setField($key, $field);  
        }
        return $this;
    }

    /**
     * hasField 
     * 
     * @param mixed $field 
     * @access public
     * @return void
     */
    public function hasField($field)
    {
        return isset($this->fields[$field]);
    }

    /**
     * getField 
     * 
     * @param mixed $field 
     * @access public
     * @return void
     */
    public function getField($field, $includeParent = true)
    {
		if(!isset($this->fields[$field])) {
            if($includeParent && $this->hasParent() && $this->getParent()->hasField($field)) {
                return $this->getParent()->getField($field);
            }
			throw new MetadataException\UnknownFieldException(sprintf('Field "%s" is not defined on Schema "%s"', $field, $this->getName()), $this, $field);
		}
		return $this->fields[$field];
    }

    /**
     * setField 
     * 
     * @param Field $field 
     * @access public
     * @return void
     */
    public function setField($key, Field $field)
    {
        $this->fields[$key] = $field;
        return $this;
    }

    /**
     * addField 
     * 
     * @param Field $field 
     * @access public
     * @return void
     */
    public function addField(Field $field)
    {
        $this->fields[$field->getName()] = $field;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isValidData($data)
    {
        return $this->getType()->isValidData($data);
    }

    /**
     * {@inheritdoc}
     */
    public function isType($type)
    {
        return $this->getType()->isType($type);
    }

    /**
     * serialize 
     * 
     * @param array $extra 
     * @access public
     * @return void
     */
    public function serialize(array $extra = array())
    {
        $extra['name'] = $this->name;
        $extra['type'] = $this->type;
        $extra['fields'] = $this->getFields()->toArray();

        return parent::serialize($extra);
    }

    /**
     * unserialize 
     * 
     * @param mixed $serialized 
     * @access public
     * @return void
     */
    public function unserialize($serialized)
    {
        $extra = parent::unserialize($serialized);
        
        $this->name   = $extra['name'];
        $this->type   = $extra['type'];
        $this->fields = new FieldCollection($extra['fields']);
        
        return $extra;
    }
}
