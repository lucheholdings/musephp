<?php
namespace Erato\Bridge\Doctrine\Annotation;

use Erato\Core\Schema\Config\SchemaConfiguration;
/**
 * Id 
 * 
 * @uses BaseAnnotation
 * @uses MappingAnnotation
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 * 
 * @Annotation
 * @Target({"PROPERTY"})
 */
class Id extends BaseAnnotation implements MappingAnnotation
{
    /**
     * getMappingName 
     * 
     * @access public
     * @return void
     */
    public function getMappingName()
    {
        return 'identifier';
    }

    public function applyMapping(SchemaConfiguration $configuration)
    {
        // set if fieldtype is specified.
        $idConfig = $configuration->getMapping('identifier');

        if(!isset($idConfig['fields'])) {
            $idConfig['fields'] = array();
        }
        $idConfig['fields'][] = $this->getReflector()->getName();
        
        $configuration->setMapping('identifier', $idConfig);
    }
}

