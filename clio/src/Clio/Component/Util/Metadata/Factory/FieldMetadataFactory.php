<?php
namespace Clio\Component\Util\Metadata\Factory;

use Clio\Component\Pattern\Registry\Registry;
use Clio\Component\Util\Type as Types;
use Clio\Component\Util\Metadata\Schema;
use Clio\Component\Util\Metadata\Field\FieldMetadata;

/**
 * FieldMetadataFactory 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FieldMetadataFactory 
{
    /**
     * schemaRegistry 
     * 
     * @var mixed
     * @access private
     */
    private $schemaRegistry;

    /**
     * __construct 
     * 
     * @param Registry $schemaRegistry 
     * @access public
     * @return void
     */
    public function __construct(Registry $schemaRegistry)
    {
        $this->schemaRegistry = $schemaRegistry;
    }

    /**
     * createFieldMetadata 
     * 
     * @param Schema $ownedSchema 
     * @param mixed $name 
     * @param mixed $type 
     * @access public
     * @return void
     */
    public function createFieldMetadata(Schema $ownedSchema, $name, $type = null)
    {
        $typeSchema = null;
        if($type) {
            if($type instanceof Schema) {
                $typeSchema = $type;
            } else if($this->getSchemaRegistry()->has($type)) {
                // Type should be registered, even the type is primitive type.
                $typeSchema = $this->getSchemaRegistry()->get($type);
            }
        }
        return new FieldMetadata($ownedSchema, $name, $typeSchema);
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
     * @param mixed $schemaRegistry 
     * @access public
     * @return void
     */
    public function setSchemaRegistry(Registry $schemaRegistry)
    {
        $this->schemaRegistry = $schemaRegistry;
        return $this;
    }
}

