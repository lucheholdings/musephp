<?php
namespace Erato\Bridge\Doctrine\Annotation;

use Erato\Core\Schema\Config\SchemaConfiguration;

/**
 * Type 
 * 
 * @uses BaseAnnotation
 * @uses FieldAnnotation
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 * 
 * @Annotation
 * @Target({"PROPERTY"})
 */
class Type extends BaseAnnotation implements FieldAnnotation 
{
    /**
     * type 
     * 
     * @var mixed
     * @access public
     */
    public $type;

    /**
     * setValue 
     * 
     * @param mixed $type 
     * @access public
     * @return void
     */
    public function setValue($type)
    {
        $this->type = $type;
    }

    /**
     * applyField 
     * 
     * @param FieldConfiguration $fieldConfiguration 
     * @access public
     * @return void
     */
    public function applyField(SchemaConfiguration $configuration)
    {
        // set if fieldtype is specified.
        if($this->type) {
            $configuration->addField($this->getReflector()->getName())->setType($this->type);
        }
    }
}

