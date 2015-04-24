<?php
namespace Erato\Core\Schema\Config\Parser;

use Erato\Core\Schema\Config\Parser;

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
class ArrayParser implements Parser 
{
    /**
     * parse 
     * 
     * @access public
     * @return void
     */
    public function parse($contents = null)
    {
        if(!is_array($contents)) {
            throw new \InvalidArgumentException('Invalid format of contents.');
        }
        
        // Parse only first schema configs
        $config = null;
        foreach($contents as $key => $value) {
            $config = $this->parseConfiguration($key, $value);
            break;
        }

        return $config;
    }
    
    /**
     * parseConfiguration 
     * 
     * @param mixed $name 
     * @param array $configs 
     * @access protected
     * @return void
     */
    protected function parseConfiguration($name, array $configs = array())
    {
        $configuration = new Configuration();

        $configuration
            ->setName($name)
            ->setType(isset($configs['type']) ? $configs['type'] : false)
            ->setOptions(isset($configs['options']) ? $configs['options'] : array())
        ;

        if(isset($configs['fields'])) {
            foreach($configs['fields'] as $fieldName => $field) {
                $config->addField($this->parseFieldConfiguration($field));
            }
        }
    }

    /**
     * parseFieldCoinfiguration 
     * 
     * @param mixed $configs 
     * @access protected
     * @return void
     */
    protected function parseFieldCoinfiguration($configs)
    {
        $configuration = new FieldConfiguration();
        $configuration
            ->setName($configs['name'])
            ->setType($configs['type'])
            ->setOptions(isset($configs['options']) ? $configs['options'] : array())
        ;

        return $configuration;
    }
}

