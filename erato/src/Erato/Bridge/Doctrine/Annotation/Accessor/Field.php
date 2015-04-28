<?php
namespace Erato\Bridge\Doctrine\Annotation\Accessor;

use Erato\Bridge\Doctrine\Annotation\BaseAnnotation;
use Erato\Bridge\Doctrine\Annotation\Metadata\SchemaMappingAnnotation;

/**
 * Fields 
 *   Fields(ignore_default="true") 
 * 
 * @uses BaseAnnotation
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 * 
 * @Annotation
 * @Target({"CLASS", "PROPERTY"})
 * 
 */
class Field extends BaseAnnotation implements MappingAnnotation 
{
    public $name;

	public $type;
    
    public function setValue($name)
    {
        $this->name = $name;
    }
    
    public function applyMapping(SchemaConfiguration $configuration)
    {
        if($this->getReflector() instanceof \ReflectionProperty) {
            // get or create target field configuration
            $field = $configuration->addField($this->getReflector()->getName());
            $accessorConfig = $field->getMapping('accessor');

            // Update configuration
            if($this->name)
                $accessorConfig['name'] = $this->name;
            if($this->type)
                $accessorConfig['type'] = $this->type;

            // set
            $field->setMapping('accessor', $accessorConfig);
        }
    }
}
