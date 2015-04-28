<?php
namespace Clio\Extra\Metadata\Mapping;

use Clio\Component\Util\Metadata;
use Clio\Component\Util\Proxy\Proxy as BaseProxy;

/**
 * Proxy 
 * 
 * @uses Mapping
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Proxy extends BaseProxy implements Metadata\Mapping
{
    /**
     * __name 
     * 
     * @var mixed
     * @access private
     */
    private $__name;

    /**
     * __metadata 
     * 
     * @var mixed
     * @access private
     */
    private $__metadata;

    /**
     * __construct 
     * 
     * @param Metadata $metadata 
     * @param mixed $name 
     * @param Mapping $wrapped 
     * @access public
     * @return void
     */
    public function __construct(Metadata\Metadata $metadata, $name, Metadata\Mapping $wrapped = null)
    {
        parent::__construct($wrapped);

        $this->__name = $name;
        $this->__metadata = $metadata;
    }

    /**
     * getName 
     * 
     * @access public
     * @return void
     */
    public function getName()
    {
        return $this->__name;
    }

    /**
     * getMetadata 
     * 
     * @access public
     * @return void
     */
    public function getMetadata()
    {
        return $this->__metadata;
    }

    /**
     * setMetadata 
     * 
     * @param Metadata $metadata 
     * @access public
     * @return void
     */
    public function setMetadata(Metadata\Metadata $metadata)
    {
        $this->__metadata = $metadata;
    }

    /**
     * __toString 
     * 
     * @access public
     * @return void
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * __setWrapped 
     * 
     * @param mixed $wrapped 
     * @access public
     * @return void
     */
    public function __setWrapped($wrapped)
    {
        if(!$wrapped instanceof Metadata\Mapping) {
            throw new \InvalidArgumentException('Proxy is only able to wrap Mapping instance.');
        }

        return parent::__setWrapped($wrapped);
    }
}

