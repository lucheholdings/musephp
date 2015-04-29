<?php
namespace Erato\Core\Schema\Config\Parser;

use Erato\Core\Schema\Config;

abstract class AbstractParser implements Config\Parser
{

    /**
     * parse 
     * 
     * @param mixed $resource 
     * @access public
     * @return void
     */
    public function parseSchemaConfiguration($resource)
    {
        $config = new Config\SchemaConfiguration();

        return $this->doParseSchemaConfiguration($config, $resource);
    }

    /**
     * doParseSchemaConfiguration 
     * 
     * @param Config\SchemaConfiguration $config 
     * @param mixed $resource
     * @abstract
     * @access protected
     * @return void
     */
    abstract protected function doParseSchemaConfiguration(Config\SchemaConfiguration $config, $resource);
}

