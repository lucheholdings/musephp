<?php
namespace Clio\Extra\Type;

use Clio\Component\Type\Type;
use Clio\Component\Metadata\Metadata;

/**
 * AbstractMetadataType 
 * 
 * @uses Type
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractMetadataType implements Type
{
    /**
     * metadata 
     * 
     * @var mixed
     * @access private
     */
    private $metadata;

    /**
     * __construct 
     * 
     * @param Metadata $metadata 
     * @access public
     * @return void
     */
    public function __construct(Metadata $metadata)
    {
        $this->metadata = $metadata;
    }

    /**
     * getName 
     * 
     * @access public
     * @return void
     */
    public function getName()
    {
        return $this->getMetadata()->getName();
    }

    /**
     * getTypeSchema 
     *   Get Schema which co-responding with this type 
     * @abstract
     * @access public
     * @return void
     */
    abstract public function getTypeSchema();

    /**
     * isType 
     * 
     * @param mixed $type 
     * @access public
     * @return void
     */
    public function isType($type)
    {
        return $this->getTypeSchema()->getType()->isType($type);
    }

    /**
     * isValidData 
     * 
     * @param mixed $data 
     * @access public
     * @return void
     */
    public function isValidData($data)
    {
        return $this->getTypeSchema()->isValidData($data);
    }
    
    /**
     * getMetadata 
     * 
     * @access public
     * @return void
     */
    public function getMetadata()
    {
        return $this->metadata;
    }
    
    /**
     * setMetadata 
     * 
     * @param mixed $metadata 
     * @access public
     * @return void
     */
    public function setMetadata(Metadata $metadata)
    {
        $this->metadata = $metadata;
        return $this;
    }

    public function __toString()
    {
        return (string)$this->getName();
    }
}

