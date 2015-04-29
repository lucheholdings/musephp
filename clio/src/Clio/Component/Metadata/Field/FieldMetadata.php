<?php
namespace Clio\Component\Metadata\Field;

use Clio\Component\Metadata\AbstractMetadata;
use Clio\Component\Metadata\Field;
use Clio\Component\Metadata\Schema;
use Clio\Component\Metadata\Schema\SchemaMetadata;
use Clio\Component\Type as Types;

/**
 * FieldMetadata 
 * 
 * @uses AbstractMetadata
 * @uses Field
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FieldMetadata extends AbstractMetadata implements Field
{
    /**
     * ownedSchema 
     *  Schema which owned this field 
     * @var mixed
     * @access private
     */
    private $ownedSchema;

    /**
     * typeSchema 
     *   Schema which type of this field. 
     * @var mixed
     * @access private
     */
    private $typeSchema;

    /**
     * __construct 
     * 
     * @param Schema $ownedSchema 
     * @param mixed $name 
     * @param Schema $typeSchema 
     * @param array $mappings 
     * @param array $options 
     * @access public
     * @return void
     */
    public function __construct(Schema $ownedSchema, $name, Schema $typeSchema = null, array $mappings = array(), array $options = array(), Field $parent = null)
    {
        parent::__construct($name, $mappings, $options, $parent);
        
        $this->ownedSchema = $ownedSchema;

        if(!$typeSchema)
            $typeSchema = 'mixed';
        $this->typeSchema = $typeSchema;
    }
    
    /**
     * getOwnedSchema 
     * 
     * @access public
     * @return void
     */
    public function getOwnedSchema()
    {
        if(!$this->ownedSchema instanceof Schema) {
            throw new \RuntimeException('OwnedSchema is not initialized yet.');
        }
        return $this->ownedSchema;
    }
    
    /**
     * setOwnedSchema 
     * 
     * @param Schema $ownedSchema 
     * @access public
     * @return void
     */
    public function setOwnedSchema(Schema $ownedSchema)
    {
        $this->ownedSchema = $ownedSchema;
        return $this;
    }

    /**
     * getOwnedSchemaName 
     * 
     * @access public
     * @return void
     */
    public function getOwnedSchemaName()
    {
        return (string)$this->ownedSchema;
    }

    /**
     * getTypeSchema 
     * 
     * @access public
     * @return void
     */
    public function getTypeSchema()
    {
        // if typeSchema is not specified, then initialized by Mixied
        if(!$this->typeSchema) {
            $this->typeSchema = new SchemaMetadata(new Types\MixedType());
        } else if(!$this->typeSchema instanceof Schema) {
            throw new \RuntimeException('TypeSchema is not initialized yet.');
        }
        return $this->typeSchema;
    }
    
    /**
     * setTypeSchema 
     * 
     * @param mixed $typeSchema 
     * @access public
     * @return void
     */
    public function setTypeSchema(Schema $typeSchema)
    {
        $this->typeSchema = $typeSchema;
        return $this;
    }

    /**
     * getTypeSchemaName 
     * 
     * @access public
     * @return void
     */
    public function getTypeSchemaName()
    {
        return (string)$this->typeSchema;
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
        if(!$parent instanceof Field) {
            throw new \InvalidArgumentException('Parent has to be a Field');
        }
        parent::setParent($parent);
        return $this;
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
        // 
        $extra['ownedSchema'] = (string)$this->ownedSchema;
        $extra['typeSchema'] = (string)$this->typeSchema;

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

        $this->ownedSchema = $extra['ownedSchema'];
        $this->typeSchema = $extra['typeSchema'];

        return $extra;
    }
}

