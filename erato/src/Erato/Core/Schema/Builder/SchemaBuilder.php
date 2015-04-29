<?php
namespace Erato\Core\Schema\Builder;

use Erato\Core\Schema\Config\SchemaConfiguration;
use Clio\Component\Metadata\Builder\SchemaBuilder as BaseBuilder;

/**
 * SchemaBuilder 
 * 
 * @uses BaseBuilder
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemaBuilder extends BaseBuilder 
{
    /**
     * setConfiguration 
     * 
     * @param Configuration $config 
     * @access public
     * @return void
     */
    public function setConfiguration(SchemaConfiguration $config)
    {
        // apply building option from config
        $this
            ->setName($config->getName())
            ->setType($config->getType())
            ->setOptions($config->getOptions())
        ;

        if($config->getParent()) {
            $this->setParent($config->getParent());
        }

        foreach($config->getFields() as $fieldName => $fieldConfig) {
            $this->addField($fieldName, $fieldConfig->type, $fieldConfig->options, $fieldConfig->getMappings(), $fieldConfig->name);
        }

        foreach($config->getMappings() as $name => $mappingConfig) {
            $this->addMapping($name, $mappingConfig);
        }
    }
}

