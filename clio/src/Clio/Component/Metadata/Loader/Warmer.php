<?php
namespace Clio\Component\Metadata\Loader;

use Clio\Component\Metadata\SchemaRegistry;
use Clio\Component\Metadata\Metadata,
    Clio\Component\Metadata\Schema,
    Clio\Component\Metadata\Field
;

/**
 * Warmer 
 *   Warmer to warm Metadata when its load. 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Warmer 
{
    /**
     * schemaRegistry 
     * 
     * @var mixed
     * @access private
     */
    private $schemaRegistry;

    /**
     * _warmings 
     * 
     * @var mixed
     * @access private
     */
    private $_warmings;

    /**
     * __construct 
     * 
     * @param SchemaRegistry $schemaRegistry 
     * @access public
     * @return void
     */
    public function __construct(SchemaRegistry $schemaRegistry)
    {
        $this->schemaRegistry = $schemaRegistry;
        $this->_warmings = array();
    }

    /**
     * warm 
     * 
     * @param Metadata $metadata 
     * @access public
     * @return void
     */
    public function warm(Metadata $metadata)
    {
        if($metadata instanceof Schema) {
            $this->_warmings[$metadata->getName()] = $metadata;
            $this->warmParent($metadata);
            $this->warmSchemaMetadata($metadata);
        } else if($metadata instanceof Field) {
            // 
            $this->warmParent($metadata);
            $this->warmFieldMetadata($metadata);
        }

        $this->warmMappings($metadata);

        unset($this->_warmings[$metadata->getName()]);
    }

    /**
     * warmParent 
     * 
     * @param Metadata $metadata 
     * @access protected
     * @return void
     */
    protected function warmParent(Metadata $metadata)
    {
        if($metadata->getParentName()) {
            $metadata->setParent($this->getSchema($metadata->getParentName()));
        }
    }

    /**
     * warmMappings 
     * 
     * @param Metadata $metadata 
     * @access protected
     * @return void
     */
    protected function warmMappings(Metadata $metadata)
    {
        // warm each mapping
        foreach($metadata->getMappings() as $mapping) {
            $this->warmMapping($mapping);
        }
    }

    /**
     * warmSchemaMetadata 
     * 
     * @param Schema $schema 
     * @access protected
     * @return void
     */
    protected function warmSchemaMetadata(Schema $schema)
    {
        foreach($schema->getFields() as $fieldname => $field) {
            $this->warm($field);
        }
    }

    /**
     * warmFieldMetadata 
     * 
     * @param Field $field 
     * @access protected
     * @return void
     */
    protected function warmFieldMetadata(Field $field)
    {
        // Load field typeSchema
        $field->setTypeSchema($this->getSchema($field->getTypeSchemaName()));
    }
    
    /**
     * getSchemaRegistry 
     * 
     * @access public
     * @return void
     */
    public function getSchemaRegistry()
    {
        return $this->schemaRegistry;
    }
    
    /**
     * setSchemaRegistry 
     * 
     * @param SchemaRegistry $schemaRegistry 
     * @access public
     * @return void
     */
    public function setSchemaRegistry(SchemaRegistry $schemaRegistry)
    {
        $this->schemaRegistry = $schemaRegistry;
        return $this;
    }

    /**
     * getSchema 
     * 
     * @param mixed $schemaName 
     * @access public
     * @return void
     */
    public function getSchema($schemaName)
    {
        // to avoid circular loading 
        if(isset($this->_warmings[$schemaName])) {
            return $this->_warmings[$schemaName];
        } else {
            return $this->getSchemaRegistry()->get($schemaName);
        }
    }
}

