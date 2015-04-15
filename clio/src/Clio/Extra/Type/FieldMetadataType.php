<?php
namespace Clio\Extra\Type;

use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Util\Metadata\Field;

/**
 * FieldMetadataType 
 *   FieldMetadataType is a Type to wrap FieldMetadata.
 *   
 * @uses AbstractMetadataType
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FieldMetadataType extends AbstractMetadataType
{
    /**
     * __construct 
     * 
     * @param Field $metadata 
     * @access public
     * @return void
     */
    public function __construct(Field $metadata)
    {
        parent::__construct($metadata);
    }

    /**
     * getTypeSchema 
     * 
     * @access public
     * @return void
     */
    public function getTypeSchema()
    {
        return $this->getMetadata()->getTypeSchema();
    }

    /**
     * setMetadata 
     * 
     * @param Metadata $metadata 
     * @access public
     * @return void
     */
    public function setMetadata(Metadata $metadata)
    {
        if(!$metadata instanceof Field) {
            throw new \InvalidArgumentException('FieldMetadataType::setMetadata only accept Field.');
        }
        return parent::setMetadata($metadata);
    }
}

