<?php
namespace Erato\Bridge\DoctrineCommon\Tests\Models;
use Erato\Bridge\DoctrineCommon\Annotation\Schema;
use Erato\Bridge\DoctrineCommon\Annotation\Schemifier;

/**
 * TestClass 
 * 
 * @Schema\Manager("Custom\ManagerClass", factory="class_factory.service")
 * @Schema\Normalizer("normalizer.service")
 * @Schema\Serializer("serializer.service")
 * @Schema\Schemifier("normalizer.service", factory="factory.service")
 * 
 * @Accessor\Fields(defaultIgnore=true)
 * @Accessor\Attributes("attributes")
 * @Accessor\Tags("tags")
 * 
 */
class TestClass 
{
    /**
     * field1 
     * 
     * @Schema\Field("ingore")
     * 
     * @Schemifier\Mapping("Other\Class", from="field")
     */
    private $field1;

    /**
     * field2 
     * 
     * @Schema\Field("integer")
     * @Accessor\AccessType("property")
     */
    public $field2;

    /**
     * instance 
     * 
     * @Schema\Field("Namespaced\ClassPath")
     * @Accessor\AccessType("method", getter="getInstance", setter="setInstance")
     */
    private $instance;

    /**
     * attribute 
     * 
     * @Schema\Field("Attribute\ClassPath")
     */
    private $attributes;

    /**
     * attribute 
     * 
     * @Schema\Field("Tag\ClassPath")
     */
    private $tags;
    
    /**
     * getField1 
     * 
     * @access public
     * @return void
     */
    public function getField1()
    {
        return $this->field1;
    }
    
    /**
     * setField1 
     * 
     * @param mixed $field1 
     * @access public
     * @return void
     */
    public function setField1($field1)
    {
        $this->field1 = $field1;
        return $this;
    }
    
    /**
     * getField2 
     * 
     * @access public
     * @return void
     */
    public function getField2()
    {
        return $this->field2;
    }
    
    /**
     * setField2 
     * 
     * @param mixed $field2 
     * @access public
     * @return void
     */
    public function setField2($field2)
    {
        $this->field2 = $field2;
        return $this;
    }
    
    /**
     * getInstance 
     * 
     * @access public
     * @return void
     */
    public function getInstance()
    {
        return $this->instance;
    }
    
    /**
     * setInstance 
     * 
     * @param mixed $instance 
     * @access public
     * @return void
     */
    public function setInstance($instance)
    {
        $this->instance = $instance;
        return $this;
    }
    
    /**
     * getAttributes 
     * 
     * @access public
     * @return void
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
    
    /**
     * setAttributes 
     * 
     * @param mixed $attributes 
     * @access public
     * @return void
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }
    
    /**
     * getTags 
     * 
     * @access public
     * @return void
     */
    public function getTags()
    {
        return $this->tags;
    }
    
    /**
     * setTags 
     * 
     * @param mixed $tags 
     * @access public
     * @return void
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
        return $this;
    }

	/**
	 * getVirtual 
	 * 
	 * @access public
	 * @return void
	 * 
	 * @Schema\Field("integer", name="virtual_field")
	 */
	public function getVirtual()
	{
		return 123;
	}
}

