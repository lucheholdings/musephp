<?php
namespace Calliope\Core\Schema;

use Calliope\Core\Schema;
use Clio\Component\Metadata\Schema\SchemaMetadata as BaseSchema;

/**
 * BasicSchema 
 *   Calliope BasicSchema.  
 *   Calliope Schema inherit Clio Metadata Schema with Manager for specified usecase. 
 * 
 * @uses BaseSchema
 * @uses Schema
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class BasicSchema extends BaseSchema implements Schema 
{
    public function __construct(BaseSchema $parent, $name, array $fields = array(), array $mappings = array(), array $options = array())
    {
        parent::__construct($schema->getType(), $name, $fields, $parent, $mappings, $options);
    }

    /**
     * getManager 
     * 
     * @access public
     * @return void
     */
    public function getManager()
    {
        return $this->getMapping('schema_manager')->getManager();
    }

    /**
     * isType 
     * 
     * @param mixed $type 
     * @access public
     * @return void
     */
    public function isType($type)
    {
        return ($this->getName() == $type) || parent::isType($type);
    }
}

