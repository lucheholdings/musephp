<?php
namespace Clio\Extra\Normalizer\Type;

use Clio\Component\Tool\Normalizer\Type\NormalizerType as BaseType;
use Clio\Extra\Type\AbstractMetadataType,
    Clio\Extra\Type\FieldMetadataType
;

/**
 * NormalizerType 
 * 
 * @uses BaseType
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class NormalizerType extends BaseType
{
    /**
     * hasField 
     * 
     * @param mixed $field 
     * @access public
     * @return void
     */
    public function hasField($field)
    {
        $type = $this->getType();
        if($type instanceof AbstractMetadataType) {
            $schema = $this->getType()->getTypeSchema();

            return $schema->hasField($field);
        }
        return parent::hasField($field);
    }

    /**
     * getFieldType 
     * 
     * @param mixed $field 
     * @access public
     * @return void
     */
    public function getFieldType($field)
    {
        $type = $this->getType();
        if($type instanceof AbstractMetadataType) {
            $schema = $this->getType()->getTypeSchema();

            if($schema->hasField($field)) {
                return new self(new FieldMetadataType($field));
            }
        }
        parent::getFieldType($field);
    }
}

