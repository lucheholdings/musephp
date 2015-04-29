<?php
namespace Clio\Component\Metadata\Mapping;

use Clio\Component\Metadata\Metadata;

/**
 * NamedFactory 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface NamedFactory
{
    /**
     * createMappingFor 
     *   Craete specified Mapping with given name. 
     * @param mixed $mappingName 
     * @param Metadata $metadata 
     * @param array $options 
     * @access public
     * @return Mapping 
     */
    function createMappingFor($mappingName, Metadata $metadata, array $options = array());
}

