<?php
namespace Erato\Core\Schema\Config\Parser;

use Erato\Core\Schema\Config;
use Clio\Component\Pattern\Parser\Exception as ParserException;

/**
 * ArrayParser 
 *   Parse to parse Array formatted configration to Configuration object
 *   { "SchemaName": {
 *      "type": "auto",
 *      "mappings": {
 *          "tags": {
 *          }
 *      },
 *      "fields": {
 *          "field": {...},
 *          ...
 *      }
 *   }}
 *   
 *   
 *   
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ArrayParser extends AbstractParser 
{
    /**
     * parse 
     * 
     * @access public
     * @return void
     */
    public function parse($resource = null)
    {
        if(!is_array($resource)) {
            throw new ParserException\InvalidResourceException('ArrayParser only accept resource as an array.');
        }

        $schema = null;
        // parse only first
        foreach($resource as $name => $config) {
            $config['name'] = $name;
            $schema = $this->parseSchemaConfiguration($config);
            break;
        }
        return $schema;
    }

    /**
     * doParseSchemaConfiguration 
     * 
     * @param Config\SchemaConfiguration $config 
     * @param mixed $resource 
     * @access protected
     * @return void
     */
    protected function doParseSchemaConfiguration(Config\SchemaConfiguration $config, $resource)
    {
        $config
            ->setName($resource['name'])
            ->setType(isset($resource['type']) ? $resource['type'] : false)
            ->setOptions(isset($resource['options']) ? $resource['options'] : array())
        ;

        if(isset($resource['fields'])) {
            foreach($resource['fields'] as $fieldName => $field) {
                $config->addField($this->doParseFieldConfiguration($field));
            }
        }

        if(isset($resource['mappings'])) {
            foreach($resource['mappings'] as $mappingName => $mappingConfig) {
                $config->setMapping($mappingName, $mappingConfig);
            }
        }
        return $config;
    }

    /**
     * doParseFieldCoinfiguration 
     * 
     * @param mixed $resource
     * @access protected
     * @return void
     */
    protected function doParseFieldCoinfiguration($resource)
    {
        $field = new FieldConfiguration();
        $field
            ->setName($resource['name'])
            ->setType($resource['type'])
            ->setOptions(isset($resource['options']) ? $resource['options'] : array())
        ;

        if(isset($resource['mappings'])) {
            foreach($resource['mappings'] as $mappingName => $mappingConfig) {
                $field->setMapping($mappingName, $mappingConfig);
            }
        }

        return $field;
    }
}

