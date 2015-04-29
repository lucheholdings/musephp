<?php
namespace Clio\Extra\Type;

use Clio\Component\Metadata\Metadata;
use Clio\Component\Metadata\Schema;

/**
 * SchemaMetadataType 
 * 
 * @uses AbstractMetadataType
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemaMetadataType extends AbstractMetadataType 
{
    /**
     * __construct 
     * 
     * @param Schema $metadata 
     * @access public
     * @return void
     */
    public function __construct(Schema $metadata)
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
        return $this->getMetadata();
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
        if(!$metadata instanceof Schema) {
            throw new \InvalidArgumentException('SchemaMetadataType::setMetadata only accept Schema.');
        }
        return parent::setMetadata($metadata);
    }

    /**
     * newData 
     * 
     * @param array $args 
     * @access public
     * @return void
     */
    public function newData(array $args = array())
    {
        return $this->getMetadata()->newData($args);
    }
}

