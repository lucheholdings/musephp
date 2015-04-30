<?php
namespace Clio\Component\Accessor\Builder;

use Clio\Component\Accessor\Field\MultiFieldAccessor;
use Clio\Component\Pattern\Factory\Exception as FactoryException;

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
                try {
                    $fieldAccessors[] = $this->fieldAccessorFactory->createFieldAccessor($field);
                } catch(FactoryException $ex) {
                    // 
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

