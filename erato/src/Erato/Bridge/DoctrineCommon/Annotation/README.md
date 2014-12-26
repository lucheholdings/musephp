## Annotations

@Schema\Field("type", name="field_name")

@Schema\Id

@Schema\Manager


## Sample Configuration


    <?php
    namespace Namespace\Path;
    use Erato\Bridge\DoctrineCommon\Annotation\Schema;
    use Erato\Bridge\DoctrineCommon\Annotation\Schemifier;
    
    /**
     * SampleClass 
     * 
     * @Schema\Manager("Custom\ManagerClass", factory="class_factory.service")
     * @Schema\Fields(ignore_default="true")
     * @Schema\Attributes("attributes")
     * @Schema\Tags("tags")
     * @Schema\Normalizer("normalizer.service")
     * @Schema\Serializer("serializer.service")
     * @Schema\Schemifier("normalizer.service", factory="factory.service")
     * 
     */
    class SampleClass implements TagContainerAware, AttributeContainerAware 
    {
        /**
         * field1 
         * 
         * @Schema\Type("ingore")
         * 
         * @Schemifier\Mapping("Other\Class", from="field")
         */
        private $field1;
    
        /**
         * field2 
         * 
         * @Schema\Type("integer")
         * @Schema\AccessType("integer")
         */
        public $field2;
    
        /**
         * instance 
         * 
         * @Schema\Type("Namespaced\ClassPath")
         * @Schema\AccessType("method")
         * @Schema\Accessor(get="getInstance", set="setInstance")
         */
        private $instance;
    
        /**
         * attribute 
         * 
         * @Schema\Type("Attribute\ClassPath")
         */
        private $attributes;
    
        /**
         * attribute 
         * 
         * @Schema\Type("Tag\ClassPath")
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
    }
    
