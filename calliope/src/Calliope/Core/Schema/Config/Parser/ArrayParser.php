<?php
namespace Calliope\Core\Schema\Config\Parser;

use Erato\Core\Schema\Config\Parser\ArrayParser as BaseParser;

/**
 * ArrayParser 
 * 
 * @uses BaseParser
 * @uses Parser
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ArrayParser extends BaseParser implements Parser 
{
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
        $config = parent::doParseSchemaConfiguration($config, $resource);

        // parse additional configuraiton for calliope
        $config
                ->setMapping('manager', array('manager_class' => $resource['manager_class']))
                ->setMapping('connection' => array('connect_to' => $resource['connect_to'], 'type' => $resource['connect_type']);
            ;

        return $config;
    }
}

