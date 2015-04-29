<?php
namespace Clio\Component\Accessor\Builder;

use Clio\Component\Accessor\Field\MultiFieldAccessor;

class SchemaAccessorBuilder  
{
    private $schemaAccessorFactory;

    private $fieldAccessorFactory;

    private $schema;

    private $fields = array();

    public function __construct($schemaAccessorFactory, $fieldAccessorFactory = null)
    {
        $this->schemaAccessorFactory = $schemaAccessorFactory;
        $this->fieldAccessorFactory = $fieldAccessorFactory;
    }

    /**
     * getSchemaAccessor 
     *   Build SchemaAccessor 
     * @access public
     * @return void
     */
    public function getSchemaAccessor()
    {
        $accessor = $this->schemaAccessorFactory->createEmtpyAccessor($this->schema);
        
        if($accessor instanceof MultiFieldAccessor) {
            $fieldAccessors = array();
            foreach($this->fields as $field) {
                if($this->fieldAccessorFactory->canCreateFieldAccessor($field)) {
                    $fieldAccessors[] = $this->fieldAccessorFactory->createFieldAccessor($field);
                }
            }
            $accessor->setFieldAccessors($fieldAccessors);
        }

        return $accessor;
    }
    
    public function setFieldAccessorFactory(FieldAccessorFactory $fieldAccessorFactory)
    {
        $this->fieldAccessorFactory = $fieldAccessorFactory;
    }

    public function setFields(array $fields)
    {
        $this->fields = $fields;
    }

    public function setSchema($schema)
    {
        $this->schema = $schema;
    }
}

