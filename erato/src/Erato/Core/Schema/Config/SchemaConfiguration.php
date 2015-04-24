<?php
namespace Erato\Core\Schema\Config;

/**
 * SchemaConfiguration 
 * 
 * @uses AbstractConfiguration
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemaConfiguration extends AbstractConfiguration implements \Serializable
{
    /**
     * name 
     * 
     * @var mixed
     * @access public
     */
    public $name;

    /**
     * type 
     * 
     * @var mixed
     * @access public
     */
    public $type;

    /**
     * fields 
     * 
     * @var mixed
     * @access public
     */
    public $fields;

    /**
     * parent 
     * 
     * @var mixed
     * @access public
     */
    public $parent;

    /**
     * addField 
     * 
     * @param FieldConfiguration $field 
     * @param mixed $alias 
     * @access public
     * @return void
     */
    public function addField(FieldConfiguration $field, $alias = null)
    {
        $this->fields[$alias ?: $field->getName()] = $field;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function merge(Configuration $config)
    {
        parent::merge($config);
        //
        $this->type = $config->type;

        // merge fields and mappings
        foreach($config->getFields() as $fieldName => $field) {
            if(isset($this->fields[$fieldName])) {
                $this->fields[$fieldName] = $this->fields[$fieldName]->merge($field);
            } else {
                $this->fields[$fieldName] = $field;
            }
        }

        return $this; 
    }

    /**
     * {@inheritdoc}
     */
    public function inherit(Configuration $config)
    {
        parent::inherit($config);

        foreach($config->getFields() as $fieldName => $field) {
            if(isset($this->fields[$fieldName])) {
                $this->fields[$fieldName] = $this->fields[$fieldName]->inherit($field);
            } else {
                $this->fields[$fieldName] = $field;
            }
        }
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
        return $this->type;
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
     * @param mixed $fields 
     * @access public
     * @return void
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
        return $this;
    }
    
    /**
     * getName 
     * 
     * @access public
     * @return void
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * setName 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * hasParent 
     * 
     * @access public
     * @return void
     */
    public function hasParent()
    {
        return (bool)$this->parent;
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
     * @param mixed $parent 
     * @access public
     * @return void
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }

    public function serialize(array $extra = array())
    {
        return serialize(array(
                $this->name,
                $this->type,
                $this->fields,
                $this->parent,
                $this->options,
                $this->mappings,
                $extra
            ));

    }

    public function unserialize($serialized)
    {
        $extra = array();
        list(
                $this->name,
                $this->type,
                $this->fields,
                $this->parent,
                $this->options,
                $this->mappings,
                $extra
            ) = unserialize($serialized);

        return $extra;
    }
}

