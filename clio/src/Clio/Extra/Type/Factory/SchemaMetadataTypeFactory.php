<?php
namespace Clio\Extra\Type\Factory;

use Clio\Component\Util\Type\Factory\AbstractTypeFactory;
use Clio\Extra\Type as ExtraTypes;
use Clio\Component\Util\Metadata\SchemaRegistry;

/**
 * SchemaMetadataTypeFactory 
 * 
 * @uses AbstractTypeFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemaMetadataTypeFactory extends AbstractTypeFactory 
{
    /**
     * schemaRegistry 
     * 
     * @var mixed
     * @access private
     */
    private $schemaRegistry;

    /**
     * __construct 
     * 
     * @param SchemaRegistry $schemaRegistry 
     * @access public
     * @return void
     */
    public function __construct(SchemaRegistry $schemaRegistry)
    {
        parent::__construct();
        $this->schemaRegistry = $schemaRegistry;
    }

    /**
     * createType 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
    public function createType($name, array $options = array())
    {
        if(!$this->schemaRegistry->has($name)) {
            throw new \InvalidArgumentException(sprintf('Schema "%s" is not exists.', $name));
        }

        return new ExtraTypes\SchemaMetadataType($this->schemaRegistry->get($name));
    }

    /**
     * isSupportedType 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
	public function isSupportedType($name)
    {
        return $this->schemaRegistry->has($name);
    }
    
    /**
     * getSchemaRegistry 
     * 
     * @access public
     * @return void
     */
    public function getSchemaRegistry()
    {
        return $this->schemaRegistry;
    }
    
    /**
     * setSchemaRegistry 
     * 
     * @param mixed $schemaRegistry 
     * @access public
     * @return void
     */
    public function setSchemaRegistry(SchemaRegistry $schemaRegistry)
    {
        $this->schemaRegistry = $schemaRegistry;
        return $this;
    }
}

